<?php

namespace Models\Ofertas;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class OfertaVehiculo extends Model
{
    use ColumnsNameTrait;

    protected $table = "ofertas__vehiculo";

    protected $guarded=[];

    public function oferta()
    {
        return $this->belongsTo(Oferta::class);
    }

}
