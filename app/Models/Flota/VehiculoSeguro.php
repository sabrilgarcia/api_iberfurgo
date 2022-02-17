<?php

namespace Models\Flota;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class VehiculoSeguro extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__vehiculo_seguro';

}
