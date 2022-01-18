<?php

namespace App\Services;

use Models\ModeloCaracteristicas;
use App\Functions\EloquentAbstraction;


class ModeloCaracteristicasService
{
    public function get($fields)
    {
        $query = new ModeloCaracteristicas();

        $query = $this->getQuery($fields, $query);
        return $query->get();
    }

    public function pluck($fields)
    {
        $query = new ModeloCaracteristicas();
        $query = $this->getQuery($fields, $query);

        return $query->get()->pluck($fields['valuePluck'], $fields['keyPluck'] ?? 'id');
    }


    public function getQuery($fields, ModeloCaracteristicas $query)
    {

        foreach ((new ModeloCaracteristicas())->getColumnsName() as $column) {
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
