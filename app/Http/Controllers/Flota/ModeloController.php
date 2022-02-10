<?php

namespace App\Http\Controllers;

use Models\Modelo;
use App\Services\ModeloService;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ModeloController extends ApiController
{
    public function __construct()
    {
        $this->defaultService = new ModeloService();
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

    public function show(Request $request, $id){

        try {
            //$delegacion = Delegacion::findOrFail($delegacion_id);
            $modelo = Modelo::with('Marca')->findOrFail($id);
                return $modelo;
        } catch(ModelNotFoundException $e){
            return $this->respondNotFound('Resource Modelo with id: ' . $id . ' not found.');
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }
}
