<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Models\Modelo;

class ModeloCaracteristicas extends Model
{
    protected $table = 'flota__modelo_caracteristicas';

    //posee un modelo
    public function modelo()
    {
        return $this->hasOne(Modelo::class, 'id', 'id');
    }

}
