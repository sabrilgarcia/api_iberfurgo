<?php

namespace App\Services;

use Models\Contacto;
use App\Functions\EloquentAbstraction;
use Exception;
use Illuminate\Support\Facades\DB;

class ContactoService
{
    public function get($fields)
    {
        $query = new Contacto();

        $query = $this->getQuery($fields, $query);
        return $query->get();
    }

    public function pluck($fields)
    {
        $query = new Contacto();
        $query = $this->getQuery($fields, $query);

        return $query->get()->pluck($fields['valuePluck'], $fields['keyPluck'] ?? 'id');
    }

    public function save($data)
    {
        DB::beginTransaction();
        try {
            $contacto = new Contacto();
            $contacto->fill($data);
            $contacto->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $contacto;
    }

    public function edit($data, $id)
    {
        DB::beginTransaction();
        try {
            $contacto = Contacto::find($id);
            $contacto->fill($data);
            $contacto->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $contacto;
    }

    public function delete($data, $id)
    {
        DB::beginTransaction();
        try {
            $reserva = Contacto::find($id);
            $reserva->delete();

            DB::commit();

            return 1;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function getQuery($fields, Contacto $query)
    {

        foreach ((new Contacto())->getColumnsName() as $column) {
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
