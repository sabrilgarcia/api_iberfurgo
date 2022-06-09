<?php

namespace App\Services\Cliente;

use App\Functions\EloquentAbstraction;
use Exception;
use Illuminate\Support\Facades\DB;
use Models\Cliente\Factura;
use Models\Cliente\FacturaSearch;

class ClienteFacturaService
{
    public function get($fields)
    {
        $query = new FacturaSearch();

        $query = FacturaSearch::getQuery($fields, $query);

        // $query = $query->where('numero','!=','NULL');

        //buscador
        if(isset($fields['numeroFactura'])){
            $query=$query->where('numero','LIKE','%'.$fields['numeroFactura'].'%');
        }
        if(isset($fields['cliente'])){
            $query=$query->where('_cliente','LIKE','%'.$fields['cliente'].'%');
        }
        if(isset($fields['fecha_factura_desde'])){
            $query=$query->where('fecha','>=',$fields['fecha_factura_desde']);
        }
        if(isset($fields['fecha_factura_hasta'])){
            $query=$query->where('fecha','<=',$fields['fecha_factura_hasta']);
        }
        if(isset($fields['base_factura_desde'])){
            $query=$query->where('base','>=',$fields['base_factura_desde']);
        }
        if(isset($fields['base_factura_hasta'])){
            $query=$query->where('base','<=',$fields['base_factura_hasta']);
        }
        if(isset($fields['iva_factura_desde'])){
            $query=$query->where('impuesto','>=',$fields['iva_factura_desde']);
        }
        if(isset($fields['iva_factura_hasta'])){
            $query=$query->where('impuesto','<=',$fields['iva_factura_hasta']);
        }
        if(isset($fields['total_factura_desde'])){
            $query=$query->where('total','>=',$fields['total_factura_desde']);
        }
        if(isset($fields['total_factura_hasta'])){
            $query=$query->where('total','<=',$fields['total_factura_hasta']);
        }
        if(isset($fields['pdte_cobro_factura_desde'])){
            $query=$query->where('pendiente','>=',$fields['pdte_cobro_factura_desde']);
        }
        if(isset($fields['pdte_cobro_factura_hasta'])){
            $query=$query->where('pendiente','<=',$fields['pdte_cobro_factura_hasta']);
        }
        if(isset($fields['matricula'])){
            $query=$query->where('matricula','LIKE','%'.$fields['matricula'].'%');
        }
        if(isset($fields['delegacion_id']) && $fields['delegacion_id']!=0){
            $arrDelegaciones=explode(',',$fields['delegacion_id']);
            if(count($arrDelegaciones)>1){
                 $query=$query->where(function($consulta) use($arrDelegaciones) {
                     $i=0;
                     foreach($arrDelegaciones as $delegacion){
                         if($i==0){
                             $consulta=$consulta->where('delegacion_id',$delegacion);
                         }else{
                             $consulta=$consulta->orWhere('delegacion_id',$delegacion);
                         }
                         $i++;
                     }
                 });
            }else{
                 $query=$query->where('delegacion_id',$fields['delegacion_id']);
            }
         }
        if(isset($fields['formapago_id']) && $fields['formapago_id']!=0){
            $query=$query->where('formapago_id',$fields['formapago_id']);
        }

        //paginador
        if(isset($fields['ordenarPor'])&&isset($fields['tipoOrden'])){
            if($fields['ordenarPor']!='fecha'){
                $query=$query->orderBy($fields['ordenarPor'],$fields['tipoOrden']);
            }else{
                $query=$query->orderBy('fecha',$fields['tipoOrden']);
                $query=$query->orderBy('fecha_proforma',$fields['tipoOrden']);
            }
        }
        if(isset($fields['pagina'])&&isset($fields['offset'])){
            $query= $query->skip(($fields['pagina']-1)*$fields['offset']);
            $query= $query->take($fields['offset']);
        }


        $facturas=$query->orderBy('fecha','DESC')->get();

        return  $facturas;
    }

    public function count($fields)
    {
        $query = new FacturaSearch();
        $query = FacturaSearch::getQuery($fields, $query);

        $query = $query->where('numero','!=','NULL');
        //buscador
        if(isset($fields['numeroFactura'])){
            $query=$query->where('numero','LIKE','%'.$fields['numeroFactura'].'%');
        }
        if(isset($fields['fecha_factura_desde'])){
            $query=$query->where('fecha','>=',$fields['fecha_factura_desde']);
        }
        if(isset($fields['fecha_factura_hasta'])){
            $query=$query->where('fecha','<=',$fields['fecha_factura_hasta']);
        }
        if(isset($fields['base_factura_desde'])){
            $query=$query->where('base','>=',$fields['base_factura_desde']);
        }
        if(isset($fields['base_factura_hasta'])){
            $query=$query->where('base','<=',$fields['base_factura_hasta']);
        }
        if(isset($fields['iva_factura_desde'])){
            $query=$query->where('impuesto','>=',$fields['iva_factura_desde']);
        }
        if(isset($fields['iva_factura_hasta'])){
            $query=$query->where('impuesto','<=',$fields['iva_factura_hasta']);
        }
        if(isset($fields['total_factura_desde'])){
            $query=$query->where('total','>=',$fields['total_factura_desde']);
        }
        if(isset($fields['total_factura_hasta'])){
            $query=$query->where('total','<=',$fields['total_factura_hasta']);
        }
        if(isset($fields['pdte_cobro_factura_desde'])){
            $query=$query->where('pendiente','>=',$fields['pdte_cobro_factura_desde']);
        }
        if(isset($fields['pdte_cobro_factura_hasta'])){
            $query=$query->where('pendiente','<=',$fields['pdte_cobro_factura_hasta']);
        }
        if(isset($fields['matricula'])){
            $query=$query->where('matricula','LIKE','%'.$fields['matricula'].'%');
        }
        if(isset($fields['delegacion_id']) && $fields['delegacion_id']!=0){
            $arrDelegaciones=explode(',',$fields['delegacion_id']);
            if(count($arrDelegaciones)>1){
                 $query=$query->where(function($consulta) use($arrDelegaciones) {
                     $i=0;
                     foreach($arrDelegaciones as $delegacion){
                         if($i==0){
                             $consulta=$consulta->where('delegacion_id',$delegacion);
                         }else{
                             $consulta=$consulta->orWhere('delegacion_id',$delegacion);
                         }
                         $i++;
                     }
                 });
            }else{
                 $query=$query->where('delegacion_id',$fields['delegacion_id']);
            }
        }
        if(isset($fields['formapago_id']) && $fields['formapago_id']!=0){
            $query=$query->where('formapago_id',$fields['formapago_id']);
        }

        return $query->count();
    }

    public function pluck($fields)
    {
        $query = new Factura();
        $query = $this->getQuery($fields, $query);

        return $query->get()->pluck($fields['valuePluck'], $fields['keyPluck'] ?? 'id');
    }

    public function save($data)
    {

        DB::beginTransaction();
        try {
            $modulo = new Factura();
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
            $modulo = Factura::find($id);
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
            $modulo = Factura::find($id);
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

    public function getQuery($fields, Factura $query)
    {

        foreach ((new Factura())->getColumnsName() as $column) {
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
