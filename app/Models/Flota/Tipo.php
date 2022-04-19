<?php

namespace Models\Flota;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Tarifa;

class Tipo extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__tipo';

    protected $appends = ['tipoId', 'precioDesde'];

    public function getTipoIdAttribute()
    {
        return $this->attributes['id'];
    }

    public function getPrecioDesdeAttribute()
    {
        $id = $this->attributes['id'];
        return Tarifa::whereRaw("tipo_id = '$id'")
        ->where('desde', 22)
        ->selectRaw("min(eur_dia) as precioDesde")
        ->first()->precioDesde;
    }
}
