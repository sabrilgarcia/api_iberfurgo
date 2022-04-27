<?php

namespace App\Http\Controllers\Flota;

use App\Http\Controllers\ApiController;
use App\Services\Flota\TipoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Models\Flota\Tipo;
use Models\Flota\Version as FlotaVersion;
use Models\Flota\VersionCaracteristicas;

class TipoController extends ApiController
{
    public function __construct()
    {
        $this->defaultService = new TipoService();
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

    public function show(Request $request, $tipo_id){

        try {
            //$delegacion = Delegacion::findOrFail($delegacion_id);
            $tipo = Tipo::where('id', $tipo_id)->firstOrFail();

            if ($tipo) {
                $version = FlotaVersion::where('tipo_id', $tipo_id)->orderBy('id', 'ASC')->first();
                if ($version) {
                    $tipo->caracteristicas = VersionCaracteristicas::find($version->id);
                } else {
                    $tipo->caracteristicas = null;
                }
                // $tipo->carga = ModeloCarga::find($modelo->id);
            }

            return $tipo;
        } catch(ModelNotFoundException $e){
            return $this->respondNotFound('Resource Tipo with id: ' . $tipo_id . ' not found.');
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }
    }


    public function get_enum_values()
    {
        $type = DB::select( DB::raw("SHOW COLUMNS FROM flota__tipo WHERE Field = 'tipo_vehiculo'") )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enum = Arr::add($enum, $v, $v);
        }

        return $enum;
    }

    public function getFamiliasVehiculo()
    {
        try {
            $results = $this->defaultService->getFamiliasVehiculo();

            return $this->respond(['data' => $results]);
        } catch(\Exception $e){
            return $this->respondInternalError($e->getTraceAsString());
        }

        return $results;
    }
}
