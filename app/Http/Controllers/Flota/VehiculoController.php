<?php

namespace App\Http\Controllers\Flota;

use App\Http\Controllers\ApiController;
use App\Http\Traits\VehiculosTrait;
use App\Services\Flota\VehiculoService;


use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Models\Flota\Vehiculo;
use Models\Flota\VehiculoSearch;
use Models\Operacion\OrdenFactura;
use Models\Tipo;

class VehiculoController extends ApiController
{
    use VehiculosTrait;

    public function __construct()
    {

        $this->defaultService = new VehiculoService();
        //$this->minRequiredFields = ['id','nombre'];
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $fields = $request->all();

            $method = isset($fields['valuePluck']) ? 'pluck' : 'get';
            $results = $this->defaultService->$method($fields);

            return $this->respond(['data' => $results]);
        } catch(\Exception $e){
            return $this->respondInternalError($e->getTraceAsString());
        }

        return $results;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            //$valid = $this->validateMinFields($data);
            //if(! $valid) {
            //    return $this->respondInvalidMinFilterFields();
            //}

            $results = $this->defaultService->save($data);

            return $this->respond(['data' => $results]);
        } catch (Exception $e) {
            return $this->respondInternalError($e->getMessage() . $e->getTraceAsString());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            //$modulo = Oferta::findOrFail($id);
            //$modulo = OfertaVehiculo::with('Marca','Modelo')->findOrFail($id);
            $vehiculo = Vehiculo::with('Version.modelo.marca','Delegacion','vehiculoAdquisicion.proveedor','vehiculoAlquiler','vehiculoSeguro','vehiculoSeguro.proveedor','vehiculoSeguro.formaPago')->findOrFail($id);
            return $this->respond(['data' => $vehiculo]);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound('Resource Modulo with id ' . $id . ' not found');
        } catch (Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $results = $this->defaultService->edit($data, $id);

            return $this->respond(['data' => $results]);
        } catch (Exception $e) {
            return $this->respondInternalError($e->getMessage() . $e->getTraceAsString());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $data = $request->all();
            // $this->minRequiredFields = ['usuario_id', 'usuario_ip'];
            $valid = $this->validateMinFields($data);
            if(! $valid) {
                return $this->respondInvalidMinFilterFields();
            }

            $results = $this->defaultService->delete($data, $id);

            return $this->respond(['data' => $results]);
        } catch (Exception $e) {
            return $this->respondInternalError($e->getTraceAsString());
        }
    }

    public function estadoVehiculosGrupo(Request $fields)
    {
        
        $vehiculosTotales = $this->getNumVehiculos('count',$fields['fecha_desde'], $fields['fecha_hasta'], $fields['delegacion_id']);
        $vehiculosAlquilados = $this->getNumVehiculosAlquilados('count',$fields['fecha_desde'], $fields['fecha_hasta'], $fields['delegacion_id']);

        $tipos = Tipo::all();
        
        $arrResultado = null;


        foreach($tipos as $tipo) {
            $totalGrupo = $this->getNumVehiculos('count',$fields['fecha_desde'], $fields['fecha_hasta'], $fields['delegacion_id'], $tipo->tipoId);
            $AlquiladosGrupo = $this->getNumVehiculosAlquilados('count',$fields['fecha_desde'], $fields['fecha_hasta'], $fields['delegacion_id'], $tipo->tipoId);
            $arrResultado[$tipo->tipoId]['total'] = $totalGrupo;
            $arrResultado[$tipo->tipoId]['alquilados'] = $AlquiladosGrupo;
            $arrResultado[$tipo->tipoId]['noAlquilados'] =  $totalGrupo - $AlquiladosGrupo;
        }

        $arrResultado['todos']['total'] = $vehiculosTotales;
        $arrResultado['todos']['alquilados'] = $vehiculosAlquilados;
        $arrResultado['todos']['noAlquilados'] = $vehiculosTotales - $vehiculosAlquilados;

        return $arrResultado;
    }
}
