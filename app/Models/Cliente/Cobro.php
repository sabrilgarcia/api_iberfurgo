<?php

namespace Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Delegacion;
use Models\Maestro\Banco;
use Models\Maestro\FormaPago;

class Cobro extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = 'cliente__cobro';

    public function delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class);
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }

}
