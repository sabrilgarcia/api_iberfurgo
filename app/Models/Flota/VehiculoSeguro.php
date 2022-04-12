<?php

namespace Models\Flota;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Maestro\FormaPago;
use Models\Proveedor\Proveedor;

class VehiculoSeguro extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__vehiculo_seguro';
    protected $guarded=[];
    public $timestamps = false;

    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }

    public function formaPago(){
        return $this->belongsTo(FormaPago::class);
    }

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }
}
