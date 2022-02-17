<?php

namespace Models\Operacion;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Cliente\Factura;

class OrdenFactura extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = "operacion__orden_factura";

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }

    public function orden()
    {
        return $this->belongsTo(Orden::class, 'id', 'id');
    }
    
}
