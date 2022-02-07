<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Models\Modelo;

class Marca extends Model
{
    protected $table = 'flota__marca';

    //una marca pertenece a varios modelos
    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'marca_id', 'id');
    }

    public function ofertaVehiculo()
    {
        return $this->hasMany(Oferta::class);
    }
}
