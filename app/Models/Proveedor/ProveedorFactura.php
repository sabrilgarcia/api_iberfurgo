<?php

namespace Models\Proveedor;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Delegacion;


class ProveedorFactura extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    public $timestamps = false;

    protected $table = 'proveedor__factura';

    public function Proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function Delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }

}
