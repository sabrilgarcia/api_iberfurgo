<?php

namespace App\Services;

use Models\Tipo;
use App\Functions\EloquentAbstraction;
use Illuminate\Support\Facades\DB;

class TipoService
{
    public function get($fields)
    {
        $query = new Tipo();

        $query = $this->getQuery($fields, $query);
        return $query->get();
    }

    public function pluck($fields)
    {
        $query = new Tipo();
        $query = $this->getQuery($fields, $query);

        return $query->get()->pluck($fields['valuePluck'], $fields['keyPluck'] ?? 'id');
    }


    public function getQuery($fields, Tipo $query)
    {

        foreach ((new Tipo())->getColumnsName() as $column) {
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

    public function getFamiliasVehiculo()
    {
        return Tipo::join('maestro__tarifa as mt', 'flota__tipo.id', '=', 'mt.tipo_id')
        ->where('mt.desde', 30)
        ->where('mt.delegacion_id', 17)
        ->select('flota__tipo.tipo_vehiculo', 'mt.eur_dia', 'flota__tipo.id')
        ->groupBy('flota__tipo.tipo_vehiculo')
        ->get();
    }
}
