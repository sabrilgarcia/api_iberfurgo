<?php

namespace Models\Soporte;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class Ticket extends Model
{
    use ColumnsNameTrait;

    protected $fillable = ['titulo','descripcion', 'categoria_id','prioridad_id',"estado_id","usuario_id"];

    protected $table = "incidencias__tickets";
}
