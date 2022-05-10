<?php

namespace Models\Reserva;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Delegacion;

class ReservaWeb extends Model
{
    use ColumnsNameTrait;

    protected $table = 'reservas__web';

    protected $guarded=[];
    public $timestamps = false;

    public function delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }
}
