<?php

namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\ApiController;
use App\Services\Reserva\ReservaWebService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Models\Reserva\ReservaWeb;

class ReservaWebController extends ApiController
{
    public function __construct()
    {
        $this->defaultService = new ReservaWebService();
        parent::__construct();
    }

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
            //$modulo = Oferta::findOrFail($id);
            $reservaWeb = ReservaWeb::findOrFail($id);
            return $this->respond(['data' => $reservaWeb]);
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
}
