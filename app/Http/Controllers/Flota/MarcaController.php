<?php

namespace App\Http\Controllers;

use Models\Marca;
use App\Services\MarcaService;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MarcaController extends ApiController
{
    public function __construct()
    {
        $this->defaultService = new MarcaService();
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

    public function show(Request $request, $marca_id){

        try {
            //$delegacion = Delegacion::findOrFail($delegacion_id);
            $marca = Marca::where('id', $marca_id)->firstOrFail();
                return $marca;
        } catch(ModelNotFoundException $e){
            return $this->respondNotFound('Resource Marca with id: ' . $marca_id . ' not found.');
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }
}
