<?php

namespace Models\Proveedor;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Delegacion;
use Models\Maestro\FormaPago;

class ProveedorPago extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    public $timestamps = false;

    protected $table = 'proveedor__pago';

    public function Delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }

    public function Factura(){
        return $this->belongsTo(ProveedorFactura::class);
    }

    public function FormaPago(){
        return $this->belongsTo(FormaPago::class);
    }

}
