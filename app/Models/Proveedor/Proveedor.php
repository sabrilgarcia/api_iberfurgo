<?php

namespace Models\Proveedor;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class Proveedor extends Model
{
    use ColumnsNameTrait;

    protected $table = 'proveedor__proveedor';



}
