<?php

namespace Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Maestro\Delegacion;
use Models\Ofertas\Oferta;

class Cliente extends Model
{
    use ColumnsNameTrait;

    protected $table = 'cliente__cliente_search';

    public function ofertas()
    {
        return $this->hasMany(Oferta::class);
    }

    public function delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }

}
