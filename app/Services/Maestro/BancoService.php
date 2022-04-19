<?php

namespace App\Services\Maestro;


use App\Functions\EloquentAbstraction;
use Models\Maestro\Banco;

class BancoService
{
    public function get($fields)
    {
        $query = new Banco();

        $query = $this->getQuery($fields, $query);
        return $query->get();
    }

    public function pluck($fields)
    {
        $query = new Banco();
        $query = $this->getQuery($fields, $query);

        return $query->get()->pluck($fields['valuePluck'], $fields['keyPluck'] ?? 'id');
    }


    public function getQuery($fields, Banco $query)
    {

        foreach ((new Banco())->getColumnsName() as $column) {
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
