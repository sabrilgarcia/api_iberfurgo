<?php

namespace App\Services\Maestro;


use App\Functions\EloquentAbstraction;
use Models\Maestro\DelegacionDatosWeb;

class DelegacionDatosWebService
{
    public function get($fields)
    {
        $query = new DelegacionDatosWeb();

        $query = $this->getQuery($fields, $query);
        return $query->get();
    }

    public function pluck($fields)
    {
        $query = new DelegacionDatosWeb();
        $query = $this->getQuery($fields, $query);

        return $query->get()->pluck($fields['valuePluck'], $fields['keyPluck'] ?? 'id');
    }


    public function getQuery($fields, DelegacionDatosWeb $query)
    {

        foreach ((new DelegacionDatosWeb())->getColumnsName() as $column) {
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
