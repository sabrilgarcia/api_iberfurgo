<?php

namespace Models\Maestro;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class DelegacionDatosWeb extends Model
{
    use ColumnsNameTrait;

    protected $table = 'maestro__delegacion_datos_web';

    protected $appends = ['oficinaNombre', 'oficinaProvincia'];

    public function delegaciones()
    {
        return $this->belongsTo(Delegacion::class, 'id', 'delegacion_id');
    }

    public function getOficinaNombreAttribute()
    {
        return Delegacion::find($this->attributes['delegacion_id'])->nombre;
    }

    public function getOficinaProvinciaAttribute()
    {
        return Delegacion::join('maestro__delegacion_direccion','maestro__delegacion.id', '=', 'maestro__delegacion_direccion.id')
                  ->join('maestro__poblacion','maestro__delegacion_direccion.poblacion_id','=','maestro__poblacion.id')
                  ->join('maestro__provincia','maestro__poblacion.provincia_id','=','maestro__provincia.id')
                  ->where('maestro__delegacion_direccion.id', $this->attributes['delegacion_id'])
                  ->select('maestro__provincia.nombre')
                  ->first()
                  ->nombre;
    }

    
}
