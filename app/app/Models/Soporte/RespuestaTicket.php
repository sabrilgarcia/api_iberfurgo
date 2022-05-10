<?php

namespace Models\Soporte;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class RespuestaTicket extends Model
{
    use ColumnsNameTrait;

    protected $table = "incidencias__respuestas_tickets";

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }

    public function tickets2()
    {
        return $this->belongsTo(RespuestaTicket::class);
    }

}
