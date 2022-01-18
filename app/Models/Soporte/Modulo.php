<?php

namespace Models\Soporte;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class Modulo extends Model
{
    use ColumnsNameTrait;

    protected $table ="incidencias__modulos";

    public function categorias()
    {
        return $this->hasOne(ModuloCategoria::class, 'modulo_id', 'id');
    }
}
