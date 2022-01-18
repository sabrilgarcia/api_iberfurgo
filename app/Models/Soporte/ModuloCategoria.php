<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class ModuloCategoria extends Model
{
    use ColumnsNameTrait;

    protected $table = "incidencias__modulos_categorias";

    public function modulos()
    {
        return $this->belongsTo(Modulo::class, 'id', 'modulo_id');
    }
}
