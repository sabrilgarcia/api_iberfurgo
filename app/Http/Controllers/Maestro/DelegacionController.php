<?php

namespace App\Http\Controllers;

use Models\Delegacion;
use App\Services\DelegacionService;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DelegacionController extends ApiController
{
    public function __construct()
    {
        $this->defaultService = new DelegacionService();
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

    public function show(Request $request, $delegacion_id)
    {

        try {
            //$delegacion = Delegacion::findOrFail($delegacion_id);
            $delegacion = Delegacion::where('id', $delegacion_id)->firstOrFail();
            return $delegacion;
        } catch(ModelNotFoundException $e){
            return $this->respondNotFound('Resource Modelo with id: ' . $delegacion_id . ' not found.');
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }
}
