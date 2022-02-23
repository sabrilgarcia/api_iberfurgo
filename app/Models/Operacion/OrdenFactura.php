<?php

namespace Models\Operacion;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use GuzzleHttp\Psr7\Request;
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

    public function ordenItem(){
        return $this->hasmany(OrdenItem::class, 'orden_id', 'id');
    }

}
