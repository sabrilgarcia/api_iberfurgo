<?php

namespace App\Http\Controllers;

use Models\Provincia;
use App\Services\ProvinciaService;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProvinciaController extends ApiController
{
    public function __construct()
    {
        $this->defaultService = new ProvinciaService();
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

    public function show(Request $request, $provincia_id)
    {

        try {
            $provincia = Provincia::where('id', $provincia_id)->firstOrFail();
            return $provincia;
        } catch(ModelNotFoundException $e){
            return $this->respondNotFound('Resource Provincia with id: ' . $provincia_id . ' not found.');
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }
}
