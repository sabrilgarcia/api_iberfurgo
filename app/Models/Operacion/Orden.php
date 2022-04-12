<?php

namespace Models\Operacion;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Cliente\Cliente;
use Models\Delegacion;

class Orden extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = "operacion__orden";

    public function ordenFactura()
    {
        return $this->hasOne(OrdenFactura::class);
    }

    public function ordenItem(){
        return $this->hasmany(OrdenItem::class);
    }

    public function ordenDetalle()
    {
        return $this->hasOne(OrdenDetalle::class, 'id', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }

}
