<?php

namespace Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;


class FacturaVehiculo extends Model
{
    use ColumnsNameTrait;

    protected $table = 'informe__facturacion_vehiculo';

    

}
