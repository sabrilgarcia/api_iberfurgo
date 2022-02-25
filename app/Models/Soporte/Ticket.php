<?php

namespace Models\Soporte;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Delegacion;
use Models\Maestro\DelegacionIndice;

class Ticket extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

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

    public function soporte()
    {
        return $this->belongsTo(Soporte::class);
    }

    public function delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }

    public function delegacionIndice()
    {
        return $this->belongsTo(DelegacionIndice::class);
    }

    public function RespuestaTicket()
    {
        return $this->hasMany(RespuestaTicket::class);
    }

}
