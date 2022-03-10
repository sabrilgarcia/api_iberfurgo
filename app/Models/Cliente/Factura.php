<?php

namespace Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;


class Factura extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = 'cliente__factura';

    

}
