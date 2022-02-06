<?php

namespace Models\Flota;

use App\Http\Traits\ColumnsNameTrait;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__vehiculo_search';

    protected $guarded=[];
}
