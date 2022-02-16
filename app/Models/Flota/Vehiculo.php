<?php

namespace Models\Flota;

use App\Http\Traits\ColumnsNameTrait;
use Illuminate\Database\Eloquent\Model;
use Models\Delegacion;
use Models\Version;

class Vehiculo extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__vehiculo';

    protected $guarded=[];

    public function version(){
        return $this->belongsTo(Version::class);
    }

    public function delegacion(){
        return $this->belongsTo(Delegacion::class);
    }

    public function vehiculoAdquisicion()
    {
        return $this->belongsTo(VehiculoAdquisicion::class, 'id', 'id');
    }

    public function vehiculoAlquiler()
    {
        return $this->belongsTo(VehiculoAlquiler::class, 'id', 'id');
    }

    public function vehiculoSeguro()
    {
        return $this->hasMany(vehiculoSeguro::class)->where('tipo','SEGURO');
    }

}
