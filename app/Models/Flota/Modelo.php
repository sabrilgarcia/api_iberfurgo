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

    public function marcas()
    {
        return $this->hasOne(Marca::class, 'id', 'marca_id');
    }


    public function ofertaVehiculo()
    {
        return $this->hasMany(OfertaVehiculo::class);
    }

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function versiones(){
        return $this->hasMany(Version::class);
    }
}
