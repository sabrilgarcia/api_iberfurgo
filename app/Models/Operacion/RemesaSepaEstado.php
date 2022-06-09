<?php

namespace Models\Operacion;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class RemesaSepaEstado extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = "operacion__remesa_estado";

    

}
