<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\ApiController;
use App\Services\Cliente\ClienteService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Models\Cliente\Cliente;

class ClienteController extends ApiController
{

    public function __construct()
    {
        $this->defaultService = new ClienteService();
        $this->minRequiredFields = ['titulo','descripcion'];
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
            $facturaVehiculo = Cliente::with('Delegacion')->findOrFail($id);

            return $this->respond(['data' => $facturaVehiculo]);
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
            $valid = $this->validateMinFields($data);
            if(! $valid) {
                return $this->respondInvalidMinFilterFields();
            }

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

    public function getClientesPendientesFacturar(Request $fields)
    {

        $query = new Cliente();

        return $query->join('operacion__orden','cliente__cliente_search.id','operacion__orden.cliente_id')
                ->join('operacion__orden_factura','operacion__orden.id','operacion__orden_factura.id')
                ->where('cliente__cliente_search.delegacion_id', $fields['delegacion_id'])
                ->whereNull('operacion__orden_factura.factura_id')
                ->where('operacion__orden.momento','CONTRATO')
                ->where('operacion__orden.alquiler','>',0)
                ->groupBy('cliente__cliente_search.id')
                ->distinct()
                ->get();
    }
}
