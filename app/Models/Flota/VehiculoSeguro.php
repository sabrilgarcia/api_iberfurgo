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

    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }

    public function formaPago(){
        return $this->belongsTo(FormaPago::class);
    }
}
