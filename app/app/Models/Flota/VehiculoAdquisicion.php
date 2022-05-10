<?php

namespace Models\Flota;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Proveedor\Proveedor;

class VehiculoAdquisicion extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__vehiculo_adquisicion';

    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }

}
