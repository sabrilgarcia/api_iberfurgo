<?php

namespace App\Http\Controllers;

use Models\ModeloCarga;
use App\Services\ModeloCargaService;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ModeloCargaController extends ApiController
{
    public function __construct()
    {
        $this->defaultService = new ModeloCargaService();
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

    public function show(Request $request, $modeloCarga_id){

        try {
            //$delegacion = Delegacion::findOrFail($delegacion_id);
            $modeloCarga = ModeloCarga::where('id', $modeloCarga_id)->firstOrFail();
                return $modeloCarga;
        } catch(ModelNotFoundException $e){
            return $this->respondNotFound('Resource Modelo with id: ' . $modeloCarga_id . ' not found.');
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }
}
