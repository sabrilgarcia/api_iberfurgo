<?php

namespace Models\Flota;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Flota\Modelo;
use Models\Flota\Vehiculo;


class Version extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__version';

    protected $guarded=[];
    public $timestamps = false;

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

    public function versionCaracteristicas()
    {
        return $this->belongsTo(VersionCaracteristicas::class, 'id', 'id');
    }

}
