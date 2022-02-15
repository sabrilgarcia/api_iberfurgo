<?php

namespace Models\Combustible;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

use Models\Maestro\DelegacionIndice;

class Combustible extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = "flota__combustible";

    

}
