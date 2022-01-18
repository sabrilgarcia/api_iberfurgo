<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Modelo;
use Models\Tipo;

class Version extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__version';

    //un modelo tiene a una marca
    public function modelos()
    {
        return $this->hasOne(Modelo::class, 'id', 'modelo_id');
    }

    //un modelo pertenece a un tipo
    // public function tipo()
    // {
    //     return $this->hasOne(Tipo::class, 'id', 'tipo_id');
    // }
}
