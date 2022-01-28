<?php

namespace Models\Ofertas;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class OfertaVehiculo extends Model
{
    use ColumnsNameTrait;

    protected $table = "ofertas__vehiculo";

}
