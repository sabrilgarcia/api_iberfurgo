<?php

namespace Models\Operacion;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class Orden extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = "operacion__orden";

    public function ordenFactura()
    {
        return $this->hasOne(OrdenFactura::class);
    }
}
