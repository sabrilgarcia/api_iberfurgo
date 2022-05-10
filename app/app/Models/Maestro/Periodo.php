<?php

namespace Models\Maestro;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class Periodo extends Model
{
    use ColumnsNameTrait;

    public $timestamps = false;
    
    protected $guarded = [];

    protected $table = "maestro__tarifa";

    

}
