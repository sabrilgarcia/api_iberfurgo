<?php

namespace Models\Flota;

use App\Http\Traits\ColumnsNameTrait;
use Illuminate\Database\Eloquent\Model;

class VehiculoSituacion extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__vehiculo_situacion';

    protected $guarded=[];

}
