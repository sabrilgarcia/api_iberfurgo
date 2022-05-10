<?php

namespace Models\Flota;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class VehiculoAlquiler extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__vehiculo_alquiler';

}
