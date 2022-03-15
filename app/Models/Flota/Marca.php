<?php

namespace Models\Flota;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

use Models\Ofertas\OfertaVehiculo;

class Marca extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__marca';

    protected $guarded=[];
    public $timestamps = false;

    //una marca pertenece a varios modelos
    public function ofertaVehiculo()
    {
        return $this->hasMany(OfertaVehiculo::class);
    }

    public function modelos(){
        return $this->hasMany(Modelo::class);
    }
}
