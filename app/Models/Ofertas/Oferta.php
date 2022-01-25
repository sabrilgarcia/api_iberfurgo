<?php

namespace Models\Ofertas;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class Oferta extends Model
{
    use ColumnsNameTrait;

    protected $table = "ofertas__ofertas";

}
