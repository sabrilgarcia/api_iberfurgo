<?php

namespace Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Delegacion;
use Models\Maestro\FormaPago;
use Models\Operacion\OrdenFactura;

class Factura extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = 'cliente__factura';

    protected $appends = ['Base','Impuestos','Total', 'PendienteCobro'];

    public function Delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }

    public function Cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    
    public function FormaPago()
    {
        return $this->belongsTo(FormaPago::class, 'formapago_id','id');
    }

    public function OrdenFactura()
    {
        return $this->belongsTo(OrdenFactura::class, 'id', 'factura_id');
    }

    public function FacturaItems()
    {
        return $this->hasMany(FacturaItem::class);
    }

    public function Cobros()
    {
        return $this->hasMany(Cobro::class);
    }

    public function getBaseAttribute()
    {
        return number_format($this->FacturaItems->sum('BaseTotal'), 2, '.', '');
    }

    public function getImpuestosAttribute()
    {
        return number_format($this->FacturaItems->sum('Impuestos'), 2, '.', '');
    }

    public function getTotalAttribute()
    {
        return number_format($this->FacturaItems->sum('Total'), 2, '.', '');
    }

    public function getPendienteCobroAttribute()
    {
        return number_format($this->Cobros->sum('importe'), 2, '.', '');
    }
}
