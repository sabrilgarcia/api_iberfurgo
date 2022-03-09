<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Modelo;
use Models\Ofertas\OfertaVehiculo;

class Marca extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__marca';

    //una marca pertenece a varios modelos
    public function ofertaVehiculo()
    {
        return $this->hasMany(OfertaVehiculo::class);
    }

    public function modelos(){
        return $this->hasMany(Modelo::class);
    }
}
