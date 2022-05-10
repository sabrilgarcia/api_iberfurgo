<?php

namespace Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Maestro\Delegacion;
use Models\Maestro\FormaPago;
use Models\Operacion\OrdenFactura;

class Factura extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = 'cliente__factura';

    protected $appends = ['NombreCliente','Base','Impuestos','Total','Cobrado','PendienteCobro'];

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

    public function Cobros(){
        return $this->hasMany(Cobro::class);
    }

    public function getNombreClienteAttribute(){
        return $this->Cliente->nombre;
    }

    public function getBaseAttribute(){
        return number_format($this->FacturaItems->sum('BaseTotal'), 2, '.', '');
    }

    public function getImpuestosAttribute(){
        return number_format($this->FacturaItems->sum('Impuestos'), 2, '.', '');
    }

    public function getTotalAttribute(){
        return number_format($this->FacturaItems->sum('Total'), 2, '.', '');
    }

    public function getCobradoAttribute(){
            return number_format($this->Cobros->sum('importe'), 2, '.', '');
    }

    public function getPendienteCobroAttribute(){

        //return $this->Total-$this->Cobrado;
        $alquiler=0;
        if(isset($this->OrdenFactura->Orden->alquiler)){
            $alquiler=$this->OrdenFactura->Orden->alquiler;
        }

        return number_format($this->Total-$this->Cobrado-$alquiler, 2, '.', '');
    }
}
