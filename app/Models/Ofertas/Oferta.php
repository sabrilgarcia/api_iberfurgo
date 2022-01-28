<?php

namespace Models\Ofertas;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Cliente\Cliente;
use Models\Delegacion;

class Oferta extends Model
{
    use ColumnsNameTrait;

    protected $table = "ofertas__oferta";

    public function delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

}
