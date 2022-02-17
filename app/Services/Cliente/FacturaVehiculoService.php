<?php

namespace App\Services\Cliente;

use App\Functions\EloquentAbstraction;
use Exception;
use Illuminate\Support\Facades\DB;
use Models\Cliente\FacturaVehiculo;

class FacturaVehiculoService
{
    public function get($fields)
    {
        $query = new FacturaVehiculo();

        $query = $this->getQuery($fields, $query);
        return $query->selectRaw("SUM(total) as total, tipo as grupo" )
                     ->groupBy('tipo')
                     ->get();       
    }

    public function pluck($fields)
    {
        $query = new FacturaVehiculo();
        $query = $this->getQuery($fields, $query);

        return $query->get()->pluck($fields['valuePluck'], $fields['keyPluck'] ?? 'id');
    }

    public function save($data)
    {
        
        DB::beginTransaction();
        try {
            $modulo = new FacturaVehiculo();
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
            $modulo = FacturaVehiculo::find($id);
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
            $modulo = FacturaVehiculo::find($id);
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

    public function getQuery($fields, FacturaVehiculo $query)
    {
        foreach ((new FacturaVehiculo())->getColumnsName() as $column) {
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