<?php

namespace Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;


class FacturaItem extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = 'cliente__factura_item';

    protected $appends = ['BaseTotal','Impuestos','Total'];

    public function getBaseTotalAttribute()
    {
        return number_format($this->cantidad*$this->base, 2, '.', '');
    }

    public function getImpuestosAttribute()
    {
        return number_format($this->BaseTotal*21/100, 2, '.', '');
    }

    public function getTotalAttribute()
    {
        return number_format($this->BaseTotal+$this->Impuestos, 2, '.', '');
    }
}
