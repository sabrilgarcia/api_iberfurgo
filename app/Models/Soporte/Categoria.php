<?php

namespace Models\Soporte;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class Categoria extends Model
{
    use ColumnsNameTrait;

    protected $table = "incidencias__modulos_categorias";

    public function modulos()
    {
        return $this->belongsTo(Modulo::class, 'id', 'modulo_id');
    }
}
