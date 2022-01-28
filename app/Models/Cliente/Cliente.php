<?php

namespace Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Ofertas\Oferta;

class Cliente extends Model
{
    use ColumnsNameTrait;

    protected $table = 'cliente__cliente_search';

    public function ofertas()
    {
        return $this->hasMany(Oferta::class);
    }

}
