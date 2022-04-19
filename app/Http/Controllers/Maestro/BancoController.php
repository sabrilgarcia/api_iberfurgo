<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\ApiController;
use App\Services\Maestro\BancoService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Models\Maestro\Banco;

class BancoController extends ApiController
{
    public function __construct()
    {
        $this->defaultService = new BancoService();
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

    public function show(Request $request, $banco_id)
    {

        try {
            $banco = Banco::where('id', $banco_id)->firstOrFail();
            return $banco;
        } catch(ModelNotFoundException $e){
            return $this->respondNotFound('Resource banco with id: ' . $banco_id . ' not found.');
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }
}
