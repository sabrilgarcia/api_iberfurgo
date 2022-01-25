<?php

namespace App\Services\Soporte;

use App\Functions\EloquentAbstraction;
use Exception;
use Illuminate\Support\Facades\DB;
use Models\Soporte\Categoria;

class CategoriaService
{
    public function get($fields)
    {
        $query = new Categoria();

        $query = $this->getQuery($fields, $query);
        return $query->get();
    }

    public function pluck($fields)
    {
        $query = new Categoria();
        $query = $this->getQuery($fields, $query);

        return $query->get()->pluck($fields['valuePluck'], $fields['keyPluck'] ?? 'id');
    }

    public function save($data)
    {
        DB::beginTransaction();
        try {
            $modulo = new Categoria();
            $modulo->fill($data);
            $modulo->save();

            DB::commit();
        } catch(Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $modulo;
    }

    public function edit($data, $id) 
    {
        DB::beginTransaction();
        try {
            $modulo = Categoria::find($id);
            $modulo->fill($data);
            $modulo->save();

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $modulo;
    }

    public function delete ($data, $id)
    {
        DB::beginTransaction();
        try {
            $modulo = Categoria::find($id);
            $modulo->fill($data);
            $modulo->save();

            $modulo->delete();
            DB::commit();

            return 1;
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getQuery($fields, Categoria $query)
    {
        foreach ((new Categoria())->getColumnsName() as $column) {
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