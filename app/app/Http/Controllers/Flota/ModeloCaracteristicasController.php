<?php

namespace App\Http\Controllers;

use Models\ModeloCaracteristicas;
use App\Services\ModeloCaracteristicasService;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ModeloCaracteristicasController extends ApiController
{
    public function __construct()
    {
        $this->defaultService = new ModeloCaracteristicasService();
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

    public function show(Request $request, $modeloCaracteristicas_id){

        try {
            //$delegacion = Delegacion::findOrFail($delegacion_id);
            $modeloCaracteristicas = ModeloCaracteristicas::where('id', $modeloCaracteristicas_id)->firstOrFail();
                return $modeloCaracteristicas;
        } catch(ModelNotFoundException $e){
            return $this->respondNotFound('Resource Modelo with id: ' . $modeloCaracteristicas_id . ' not found.');
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }
}
