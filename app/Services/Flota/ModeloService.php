<?php

namespace App\Services;

use Models\Modelo;
use App\Functions\EloquentAbstraction;


class ModeloService
{
    public function get($fields)
    {
        $query = new Modelo();

        $query = $this->getQuery($fields, $query);
        return $query->with('Marca')->get();
    }

    public function pluck($fields)
    {
        $query = new Modelo();
        $query = $this->getQuery($fields, $query);

        return $query->get()->pluck($fields['valuePluck'], $fields['keyPluck'] ?? 'id');
    }


    public function getQuery($fields, Modelo $query)
    {

        foreach ((new Modelo())->getColumnsName() as $column) {
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
