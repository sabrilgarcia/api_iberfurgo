<?php

namespace App\Http\Controllers;

use Models\DelegacionDatosWeb;
use App\Services\DelegacionDatosWebService;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DelegacionDatosWebController extends ApiController
{
    public function __construct()
    {
        $this->defaultService = new DelegacionDatosWebService();
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

    public function show(Request $request, $delegacionDatosWeb_id)
    {

        try {
            //$delegacion = Delegacion::findOrFail($delegacion_id);
            $delegacionDatosWeb = DelegacionDatosWeb::where('id', $delegacionDatosWeb_id)->firstOrFail();
            return $delegacionDatosWeb;
        } catch(ModelNotFoundException $e){
            return $this->respondNotFound('Resource DelegacionDatosWeb with id: ' . $delegacionDatosWeb_id . ' not found.');
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }
}
