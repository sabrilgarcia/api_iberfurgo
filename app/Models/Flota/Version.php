<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Flota\Vehiculo;
use Models\Modelo;
use Models\Tipo;

class Version extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__version';

    public function modelos()
    {
        return $this->hasOne(Modelo::class, 'id', 'modelo_id');
    }

    public function modelo(){
        return $this->belongsTo(Modelo::class);
    }

    public function vehiculos(){
        return $this->hasMany(Vehiculo::class);
    }

}
