<?php

namespace App\Http\Controllers\Operacion;

use App\Http\Controllers\ApiController;
use App\Services\Operacion\OrdenFacturaService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Models\Operacion\OrdenFactura;

class OrdenFacturaController extends ApiController
{

    public function __construct()
    {
        $this->defaultService = new OrdenFacturaService();

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
            $ordenFactura = OrdenFactura::with('Orden', 'Factura')->findOrFail($id);

            return $this->respond(['data' => $ordenFactura]);
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


            $results = $this->defaultService->delete($data, $id);

            return $this->respond(['data' => $results]);
        } catch (Exception $e) {
            return $this->respondInternalError($e->getTraceAsString());
        }
    }

    public function getContratosSinFactura(Request $fields)
    {
        $query = new OrdenFactura();

        return $query->with('Orden')
                ->join('operacion__orden','operacion__orden_factura.id','operacion__orden.id')
                ->where('operacion__orden.cliente_id', $fields['cliente_id'])
                ->whereNull('operacion__orden_factura.factura_id')
                ->where('operacion__orden.momento','CONTRATO')
                ->get();
    }
}
