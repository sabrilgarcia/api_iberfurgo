<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class DelegacionDatosWeb extends Model
{
    use ColumnsNameTrait;

    protected $table = 'maestro__delegacion_datos_web';

    protected $appends = ['oficinaNombre'];

    public function delegaciones()
    {
        return $this->belongsTo(Delegacion::class, 'id', 'delegacion_id');
    }

    public function getOficinaNombreAttribute()
    {
        return Delegacion::find($this->attributes['delegacion_id'])->nombre;
    }

    
}
