<?php

namespace Models\Operacion;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Flota\Vehiculo;

class OrdenDetalle extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = "operacion__orden_detalles";

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

}
