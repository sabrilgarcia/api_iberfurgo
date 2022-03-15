<?php

namespace Models\Proveedor;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class TipoProveedor extends Model
{
    use ColumnsNameTrait;

    protected $table = 'proveedor__tipo_proveedor';

}
