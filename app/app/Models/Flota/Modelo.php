<?php

namespace Models\Flota;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

use Models\Ofertas\OfertaVehiculo;


class Modelo extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__modelo';

    protected $guarded=[];
    public $timestamps = false;

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
