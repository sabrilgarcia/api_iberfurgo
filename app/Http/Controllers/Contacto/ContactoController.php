<?php

namespace App\Http\Controllers;

use Models\Contacto;
use App\Services\ContactoService;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactoController extends ApiController
{
    public function __construct()
    {
        $this->defaultService = new ContactoService();
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

    public function show(Request $request, $contacto_id){

        try {
            //$delegacion = Delegacion::findOrFail($delegacion_id);
            $modelo = Contacto::where('id', $contacto_id)->firstOrFail();
                return $modelo;
        } catch(ModelNotFoundException $e){
            return $this->respondNotFound('Resource Contacto with id: ' . $contacto_id . ' not found.');
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $results = $this->defaultService->save($data);

            return $this->respond(['data' => $results]);
        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $results = $this->defaultService->edit($data, $id);

            return $this->respond(['data' => $results]);
        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $data = $request->all();
            $results = $this->defaultService->delete($data, $id);

            return $this->respond(['data' => $results]);
        } catch (\Exception $e) {

            return $this->respondInternalError($e->getTraceAsString());
        }
    }
}
