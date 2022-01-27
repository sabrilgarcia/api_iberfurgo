<?php

namespace Models\Soporte;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use App\User;
use Models\Delegacion;

class Ticket extends Model
{
    use ColumnsNameTrait;

    protected $fillable = ['titulo','descripcion', 'observaciones_internas','modulo_id','categoria_id','prioridad_id',"estado_id","usuario_id", 'soporte_id','delegacion_id'];

    protected $table = "incidencias__tickets";

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }

}
