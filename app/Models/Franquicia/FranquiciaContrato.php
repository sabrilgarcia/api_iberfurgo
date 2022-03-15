<?php

namespace Models\Franquicia;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class FranquiciaContrato extends Model
{
    use ColumnsNameTrait;

    public $timestamps = false;
    
    protected $guarded = [];

    protected $table = "franquicia__contrato";

    

}
