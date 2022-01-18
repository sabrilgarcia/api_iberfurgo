<?php

namespace App\Services;

use Models\Tarifa;
use Models\Tipo;
use App\Functions\EloquentAbstraction;
use Carbon\Carbon;

class TarifaService
{
    public function get($fields)
    {
        $query = new Tarifa();

        $query = $this->getQuery($fields, $query);
        return $query->get();
    }

    public function pluck($fields)
    {
        $query = new Tarifa();
        $query = $this->getQuery($fields, $query);

        return $query->get()->pluck($fields['valuePluck'], $fields['keyPluck'] ?? 'id');
    }


    public function getQuery($fields, Tarifa $query)
    {

        foreach ((new Tarifa())->getColumnsName() as $column) {
            if (isset($fields[$column])) {
                $query = EloquentAbstraction::addQueryRule($query, $column, $fields[$column]);
            }
        }

        if (isset($fields['take'])) {
            $skip = $fields['skip'] ?? 0;
            $query = $query->skip($skip)->take($fields['take']);
        }

        if (isset($fields['order'])) {
            foreach ($fields['order'] as $element) {
                $query = $query->orderByRaw($element);
            }
        }

        return $query;
    }

    public function getSumDay($startDate, $endDate)
    {
        //horas, ver si sumamos un dia mas o no
        $sum = 0;
        $diffHours = $endDate->hour - $startDate->hour;
        if ($diffHours >= 2) {
            if ($startDate->minute == 30 && $endDate->minute == 0 && $diffHours > 2) {
                $sum = 1;
            } elseif ($startDate->minute == 0 && $endDate->minute == 30) {
                $sum = 1;
            } elseif ($endDate->hour - $startDate->hour > 2) {
                $sum = 1;
            }
        }

        return $sum;
    }

    public function calculateTarifa(&$tarifa, $days)
    {
        $tarifa->importe_vehiculo = $tarifa->eur_dia * $days;
        $tarifa->importe_vehiculo_iva = $tarifa->importe_vehiculo * Tarifa::IVA;
        $tarifa->dias = $days;
        $tarifa->tipo = Tipo::find($tarifa->tipo_id);
    }

    public function unTramo($fields, $startDate, $endDate, $days)
    {
        $rangeDays = [0, 2, 3 , 4, 7, 14, 30];
        $desde = -1;
        if (in_array($days, $rangeDays)) {
            $desde = $days;
        } else {
            foreach ($rangeDays as $key => $day) {
                if ($days < $day) {
                    $desde = $rangeDays[$key - 1];
                    break;
                }
            }
        }
        $tarifas = Tarifa::where('tipo_tarifa', $fields['tipo_tarifa'])
                    ->where('delegacion_id', $fields['delegacion_id'])
                    ->where('desde', $desde)
                    ->where('fecha_inicio', '<=', $startDate->format('Y-m-d'))
                    ->where('fecha_fin', '>=', $endDate->format('Y-m-d'))
                    ->get();

        foreach ($tarifas as &$tarifa) {
            if ($days == 0) {
                $days = 1;
            }
            $this->calculateTarifa($tarifa, $days);
        }

        if (count($tarifas)) {
            $tarifas = $tarifas->sortBy('importe_vehiculo');
            return $tarifas;
        }

        return null;

    }

    public function variosTramos($fields, $startDate, $endDate, $daysDate, $startDateFull, $endDateFull)
    {
        $rangeDays = [0, 2, 3 , 4, 7, 14, 30];
        $desde = -1;
        if (in_array($daysDate, $rangeDays)) {
            $desde = $daysDate;
        } else {
            foreach ($rangeDays as $key => $day) {
                if ($daysDate < $day) {
                    $desde = $rangeDays[$key - 1];
                    break;
                }
            }
        }
        $tipos = Tarifa::where('tipo_tarifa', $fields['tipo_tarifa'])
        ->where('delegacion_id', $fields['delegacion_id'])
        ->where('desde', $desde)
        // ->orderBy('fecha_inicio', 'ASC')
        ->groupBy('tipo_id')
        ->pluck('tipo_id');

        $tarifasFinales = [];

        foreach ($tipos as $tipo) {
            $tarifas = Tarifa::where('tipo_tarifa', $fields['tipo_tarifa'])
                        ->where('delegacion_id', $fields['delegacion_id'])
                        ->where('desde', $desde)
                        ->where('tipo_id', $tipo)
                        ->orderBy('fecha_inicio', 'ASC')
                        ->get();

            $searchTarifas = [];

            foreach ($tarifas as $tarifa)
            {
                $cond1 = $startDate->isBetween(Carbon::createFromFormat('Y-m-d', $tarifa->fecha_inicio), Carbon::createFromFormat('Y-m-d', $tarifa->fecha_fin));
                $cond2 = $endDate->isBetween(Carbon::createFromFormat('Y-m-d', $tarifa->fecha_inicio), Carbon::createFromFormat('Y-m-d', $tarifa->fecha_fin));
                $cond3 = Carbon::createFromFormat('Y-m-d', $tarifa->fecha_inicio)->isBetween($startDate, $endDate);
                $cond4 = Carbon::createFromFormat('Y-m-d', $tarifa->fecha_fin)->isBetween($startDate, $endDate);
                if ($cond1 || $cond2 || $cond3 || $cond4)
                {
                    $searchTarifas[] = $tarifa;
                }
            }

            $tarifa_importe_vehiculo = 0;

            if (empty($searchTarifas)) {
                return null;
            }

            foreach ($searchTarifas as $key => $value) {
                //estamos en primer tramo
                if ($key == 0) {
                    $days = $startDate->diffInDays(Carbon::createFromFormat('Y-m-d', $value->fecha_fin)) + 1;
                    $tarifa_importe_vehiculo += $value->eur_dia * $days;
                }
                //ultimo tramos
                elseif ($key == count($searchTarifas) - 1) {
                    $days = Carbon::createFromFormat('Y-m-d', $value->fecha_inicio)->diffInDays($endDate);
                    $days += $this->getSumDay($startDateFull, $endDateFull);
                    $tarifa_importe_vehiculo += $value->eur_dia * $days;
                }
                //tramos intermedios
                else {
                    $days = Carbon::createFromFormat('Y-m-d', $value->fecha_inicio)->diffInDays(Carbon::createFromFormat('Y-m-d', $value->fecha_fin)) + 1;
                    $tarifa_importe_vehiculo += $value->eur_dia * $days;
                }

                $value->importe_vehiculo = $tarifa_importe_vehiculo;
                $value->importe_vehiculo_iva = $value->importe_vehiculo * Tarifa::IVA;
                $value->dias = $days;
                $value->tipo = Tipo::find($value->tipo_id);
            }

            if ($key == count($searchTarifas) - 1) {
                $tarifasFinales[] = $value;
            }
        }

        if (count($tarifasFinales)) {
            //ordenar por importe_vehiculo
            foreach ($tarifasFinales as $key => $value) {
                $aux[$key] = $value['importe_vehiculo'];
            }
            array_multisort($aux, SORT_ASC, $tarifasFinales);
            return $tarifasFinales;
        }

        return null;
    }

    public function getTarifa($fields)
    {

        //sacar cuantos dias hay entre las dos fechas
        $startDateFull = Carbon::createFromFormat('Y-m-d H:i', $fields['fecha_inicio']);
        $endDateFull = Carbon::createFromFormat('Y-m-d H:i', $fields['fecha_fin']);

        $startDate = Carbon::createFromFormat('Y-m-d', substr($fields['fecha_inicio'], 0, 10));
        $endDate = Carbon::createFromFormat('Y-m-d', substr($fields['fecha_fin'], 0, 10));

        if ($fields['tipo_tarifa'] == 'HOUR') {
            $rangeHours = [0, 2];
            $desde = -1;
            if (in_array($fields['horas'], $rangeHours)) {
                $desde = $fields['horas'];
            } else {
                foreach ($rangeHours as $key => $hour) {
                    if ($fields['horas'] < $hour) {
                        $desde = $rangeHours[$key - 1];
                        break;
                    }
                }
            }
            $tarifa = Tarifa::where('tipo_tarifa', $fields['tipo_tarifa'])
            ->where('delegacion_id', $fields['delegacion_id'])
            ->where('desde', $desde) //4<=5
            ->where('fecha_inicio', '<=', $startDate->format('Y-m-d'))
            ->where('fecha_fin', '>=', $endDate->format('Y-m-d'))
            ->first();

            $tarifa->importe_vehiculo = $tarifa->eur_hora * $fields['horas'];
            $tarifa->importe_vehiculo_iva = $tarifa->importe_vehiculo * Tarifa::IVA;
            $tarifa->dias = 0;

            return $tarifa;

        }

        $daysDate = $startDate->diffInDays($endDate);
        $daysDate += $this->getSumDay($startDateFull, $endDateFull);

        //aqui buscaremos los tramos por las fechas
        //caso 1, que fecha coincida con un tramo
        $tarifas = $this->unTramo($fields, $startDate, $endDate, $daysDate);

        if ($tarifas) {
            return $tarifas;
        }

        //caso 2, buscamos más de un tramo
        //seleccionamos tipos que hay
        $tarifas = $this->variosTramos($fields, $startDate, $endDate, $daysDate, $startDateFull, $endDateFull);

        if ($tarifas) {
            return $tarifas;
        }

        return 'error';

        // return [$tarifa_importe_vehiculo, $tarifa_importe_vehiculo * Tarifa::IVA];
    }


    //no se usa
    public function getSearchResults($results, $fields)
    {
        foreach ($results as $result)
        {
            $result->days = $this->getDays($fields->fecha_inicio, $fields->fecha_fin);

            $startDateTime =  $fields->get('fecha_inicio') . ' ' . $fields->get('hora_fin', 'default');
            $endDateTime = $fields->get('fecha_fin') . ' ' . $fields->get('hora_fin', 'default');

            $result->hours = $this->getHours($startDateTime, $endDateTime);

            $tipoTarifa = ($result->hours > 4 ) ? $fields->tipo_tarifa = 'DAY' : $fields->tipo_tarifa = 'HOUR';

        }
    }

    public function getDays($startDate, $endDate) {
        $startDateToString = strtotime($startDate);
        $endDateToString = strtotime($endDate);
        $diffDays = $endDateToString - $startDateToString;
        return round($diffDays / 86400);
    }

    public function getHours($startDate,$endDate)
    {
        $startDateToTimestamp = strtotime($startDate);
        $endDateToTimestamp = strtotime($endDate);
        $difference = $endDateToTimestamp - $startDateToTimestamp;
        $dif_time = floor($difference / (60) )/60;
        return $dif_time;
    }
}
