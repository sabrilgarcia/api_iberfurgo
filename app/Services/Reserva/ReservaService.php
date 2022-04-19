<?php

namespace App\Services;

use Models\Reserva;
use App\Functions\EloquentAbstraction;
use Exception;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Carbon;
use Models\Flota\Tipo;

class ReservaService
{
    public function get($fields)
    {
        $query = new Reserva();

        $query = $this->getQuery($fields, $query);
        return $query->get();
    }

    public function pluck($fields)
    {
        $query = new Reserva();
        $query = $this->getQuery($fields, $query);

        return $query->get()->pluck($fields['valuePluck'], $fields['keyPluck'] ?? 'id');
    }

    public function save($data)
    {
        DB::beginTransaction();
        try {
            $reserva = new Reserva();
            //cogemos datos flota
            $flota = Tipo::find($data['tipo_id']);
            $data['groupo_vehi'] = $flota->tipo_vehiculo;
            $data['fecha_reco'] = Carbon::createFromFormat('d/m/Y', $data['fecha_reco'])->format('Y-m-d');
            $data['fecha_dev'] = Carbon::createFromFormat('d/m/Y', $data['fecha_dev'])->format('Y-m-d');
            $reserva->fill($data);
            $reserva->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $reserva;
    }

    public function edit($data, $id)
    {
        DB::beginTransaction();
        try {
            $reserva = Reserva::find($id);
            $reserva->fill($data);
            $reserva->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $reserva;
    }

    public function delete($data, $id)
    {
        DB::beginTransaction();
        try {
            $reserva = Reserva::find($id);
            $reserva->delete();

            DB::commit();

            return 1;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function getQuery($fields, Reserva $query)
    {

        foreach ((new Reserva())->getColumnsName() as $column) {
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
}
