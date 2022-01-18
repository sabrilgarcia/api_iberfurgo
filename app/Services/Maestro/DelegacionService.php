<?php

namespace App\Services;

use Models\Delegacion;
use App\Functions\EloquentAbstraction;


class DelegacionService
{
    public function get($fields)
    {
        $query = new Delegacion();

        $query = $this->getQuery($fields, $query);
        return $query->with('DelegacionDatosWeb')->get();
    }

    public function pluck($fields)
    {
        $query = new Delegacion();
        $query = $this->getQuery($fields, $query);

        return $query->get()->pluck($fields['valuePluck'], $fields['keyPluck'] ?? 'id');
    }


    public function getQuery($fields, Delegacion $query)
    {

        foreach ((new Delegacion())->getColumnsName() as $column) {
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
