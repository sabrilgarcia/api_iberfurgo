<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;
use Models\Flota\VehiculoSearch;
use Models\Flota\VehiculoSituacion;

trait VehiculosTrait
{
    public function getEstadoVehiculo($id,$fecha){
        //sacar situacion del vehiculo
        $arrEstados=['BAJA','MANTENIMIENTO','AVERIADO','ESPERANDO','PREVENTA'];
        $situacionVehiculo=VehiculoSituacion::find($id);
            if(in_array($situacionVehiculo->estado,$arrEstados)){
                $fecha_estado=date_create($situacionVehiculo->fecha_transaccion)->format('Y-m-d');
                if($fecha>=$fecha_estado){
                    $data=[
                        'estado'=> $situacionVehiculo->estado,
                    ];
                    return json_encode($data);
                }
            }
            //si esta disponible calcular si tiene contrato o reserva
            //buscamos en orden si

            $resultado = VehiculoSearch::leftJoin('operacion__orden_search', 'operacion__orden_search.vehiculo_id', 'flota__vehiculo_search.id');
            $resultado = $resultado->where('flota__vehiculo_search.id',$id);
            $resultado = $resultado->whereRaw("(
                (operacion__orden_search.fecha_entrega <= ' " . $fecha . " ' AND operacion__orden_search.fecha_recogida >= '  " . $fecha . " ')
                OR (operacion__orden_search.fecha_entrega >= ' " . $fecha . " ' AND operacion__orden_search.fecha_entrega <= ' " . $fecha . " ' AND operacion__orden_search.fecha_recogida >= ' " . $fecha . " ')
                OR (operacion__orden_search.fecha_entrega <= ' " . $fecha . " ' AND operacion__orden_search.fecha_recogida >= ' " . $fecha . " ' AND operacion__orden_search.fecha_recogida <= ' " . $fecha . " ')
            )");
            $resultado=$resultado->get();
            $reservado=false;
            $alquilado=false;
            foreach($resultado as $orden){
              if($orden->momento=='RESERVA'){
                  $reservado=true;
              }
              if($orden->momento=='CONTRATO'){
                $alquilado=true;
              }
            }
            if($alquilado){
                $data=[
                    'estado'=> 'ALQUILADO',
                ];
                return json_encode($data);
            }
            if($reservado){
                $data=[
                    'estado'=> 'RESERVADO',
                ];
                return json_encode($data);
            }
            $data=[
                'estado'=> 'LIBRE',
            ];
            return json_encode($data);

    }

    public function getNumVehiculos($tipo = 'get', $fecha_desde, $fecha_hasta, $delegacion_id = null, $grupo = null)
    {
        $resultado =  VehiculoSearch::leftJoin('franquicia__contrato', 'franquicia__contrato.vehiculo_id', 'flota__vehiculo_search.id');
        $hoy = date('Y-m-d');
        $sql = "SELECT  v.id,
                        IF(ISNULL(fc.fecha_inicio) = 1, v.fecha_matricula, fc.fecha_inicio) as fecha_inicio,
                        IF(ISNULL(fc.fecha_fin) = 1, '".$hoy."', fc.fecha_fin) as fecha_fin

                FROM flota__vehiculo_search v
                LEFT JOIN franquicia__contrato fc on v.id = fc.vehiculo_id

                WHERE v.id > 0";

                if($delegacion_id){
                    $sql .= " AND v.delegacion_id =" . $delegacion_id;
                }

                if($grupo){
                    $sql .= " AND v.grupo = '" . $grupo . "'";
                }

                $sql .= " AND (
                            (fecha_inicio <= ' " . $fecha_desde . " ' AND IF(ISNULL(fecha_fin) = 1 , '".$hoy."' , fecha_fin) >= '  " . $fecha_hasta . " ')
                            OR (fecha_inicio >= ' " . $fecha_desde . " ' AND fecha_inicio <= ' " . $fecha_hasta . " ' AND IF(ISNULL(fecha_fin) = 1 ,'".$hoy."' , fecha_fin) >= ' " . $fecha_hasta . " ')
                            OR (fecha_inicio <= ' " . $fecha_desde . " ' AND IF(ISNULL(fecha_fin) = 1 ,'".$hoy."' , fecha_fin) >= ' " . $fecha_desde . " ' AND IF(ISNULL(fecha_fin) = 1 ,'".$hoy."' , fecha_fin) <= ' " . $fecha_hasta . " ')
                        )";
        $resultado =  DB::select(DB::raw($sql));


        if($tipo == 'count') {
            $resultado = count($resultado);
            return $resultado;
        }

        return $resultado;
    }

    public function getNumVehiculosAlquilados($tipo = 'get', $fecha_desde, $fecha_hasta, $delegacion_id = null, $grupo = null)
    {
        $query = new VehiculoSearch();

        $resultado = $query->leftJoin('operacion__orden_search', 'operacion__orden_search.vehiculo_id', 'flota__vehiculo_search.id');

        if($delegacion_id){
            $resultado = $resultado->where('flota__vehiculo_search.delegacion_id',  $delegacion_id);
        }

        if($grupo){
            $resultado = $resultado->where('flota__vehiculo_search.grupo', $grupo);
        }

        $resultado = $resultado->whereRaw("(
            (operacion__orden_search.fecha_entrega <= ' " . $fecha_desde . " ' AND operacion__orden_search.fecha_recogida >= '  " . $fecha_hasta . " ')
            OR (operacion__orden_search.fecha_entrega >= ' " . $fecha_desde . " ' AND operacion__orden_search.fecha_entrega <= ' " . $fecha_hasta . " ' AND operacion__orden_search.fecha_recogida >= ' " . $fecha_hasta . " ')
            OR (operacion__orden_search.fecha_entrega <= ' " . $fecha_desde . " ' AND operacion__orden_search.fecha_recogida >= ' " . $fecha_desde . " ' AND operacion__orden_search.fecha_recogida <= ' " . $fecha_hasta . " ')
        )");

        if($tipo == 'count') {
            $resultado = $resultado->count();
            return $resultado;
        }

        return $resultado->get();

    }


}
