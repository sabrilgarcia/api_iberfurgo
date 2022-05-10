<?php

namespace Models\Ofertas;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Flota\Marca;
use Models\Flota\Modelo;

class OfertaVehiculo extends Model
{
    use ColumnsNameTrait;

    protected $table = "ofertas__vehiculo";
    public $timestamps = false;
    protected $guarded=[];

    public function oferta()
    {
        return $this->belongsTo(Oferta::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

}
