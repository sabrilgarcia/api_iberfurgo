<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\ApiController;
use App\Services\Maestro\TarifaService;
use Models\Maestro\Tarifa;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class TarifaController extends ApiController
{
    public function __construct()
    {
        $this->defaultService = new TarifaService();
        parent::__construct();
    }

    public function index(Request $request)
    {
        try {
            $fields = $request->all();
            $method = isset($fields['valuePluck']) ? 'pluck' : 'get';
            $results = $this->defaultService->$method($fields);

            $this->defaultService->getSearchResults($results, $request);

            return $this->respond(['data' => $results]);
        } catch(\Exception $e){
            return $this->respondInternalError($e->getTraceAsString());
        }

        return $results;
    }

    public function show(Request $request, $tarifa_id){

        try {
            //$Tarifa = Tarifa::findOrFail($Tarifa_id);
            $tarifa = Tarifa::where('id', $tarifa_id)->firstOrFail();
                return $tarifa;
        } catch(ModelNotFoundException $e){
            return $this->respondNotFound('Resource Tarifa with id: ' . $tarifa_id . ' not found.');
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }

    public function getTarifa(Request $request)
    {
        try {
            $fields = $request->all();
            $validator = Validator::make($fields, Tarifa::rules());

            if ($validator->fails()) {
                return response()->json(['success' => false, 'error'=>$validator->errors()], 401);
            }

            $results = $this->defaultService->getTarifa($fields);
            return $this->respond(['data' => $results]);
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }

    public function getTarifaFreeDay(Request $request)
    {
        try {
            $fields = $request->all();
            $validator = Validator::make($fields, Tarifa::rules());

            if ($validator->fails()) {
                return response()->json(['success' => false, 'error'=>$validator->errors()], 401);
            }

            $results = $this->defaultService->getTarifaFreeDay($fields);
            return $this->respond(['data' => $results]);
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }

    public function getPeriodos(Request $request)
    {
        $anyo = $request['anyo'];
        
        $periodos = DB::table('maestro__tarifa')
                    ->select('fecha_inicio', 'fecha_fin')
                    ->where('fecha_inicio' , '>=' , $anyo.'-01-01')
                    ->where('fecha_fin' , '<=' , $anyo.'-12-31')
                    ->distinct()
                    ->get();
        
        return $periodos;
                    
    }
}
