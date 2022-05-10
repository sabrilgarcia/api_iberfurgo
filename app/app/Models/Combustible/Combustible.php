<?php

namespace Models\Combustible;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
class Combustible extends Model
{
    use ColumnsNameTrait;

    public $timestamps = false;
    
    protected $guarded = [];

    protected $table = "flota__combustible";

    

}
