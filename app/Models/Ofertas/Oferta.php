<?php

namespace Models\Ofertas;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Cliente\Cliente;
use Models\Delegacion;
use Models\Maestro\DelegacionIndice;

class Oferta extends Model
{
    use ColumnsNameTrait;

    protected $table = "ofertas__oferta";

    protected $guarded=[];

    public function delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function delegacionIndice()
    {
        return $this->belongsTo(DelegacionIndice::class);
    }
}
