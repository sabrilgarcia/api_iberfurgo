<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Marca;
use Models\Ofertas\OfertaVehiculo;
use Models\Tipo;

class Modelo extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__modelo';

    //un modelo tiene a una marca
    public function marcas()
    {
        return $this->hasOne(Marca::class, 'id', 'marca_id');
    }

    //un modelo pertenece a un tipo
    // public function tipo()
    // {
    //     return $this->hasOne(Tipo::class, 'id', 'tipo_id');
    // }

    public function ofertaVehiculo()
    {
        return $this->hasMany(OfertaVehiculo::class);
    }
}
