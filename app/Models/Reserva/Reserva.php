<?php

namespace Models\Reserva;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class Reserva extends Model
{
    use ColumnsNameTrait;

    protected $table = 'reservas__web';

    protected $fillable = ['nombre', 'dni', 'direccion', 'telefono', 'email', 'formaPago', 'observaciones', 'delegacion',
    'fecha_reco', 'fecha_dev', 'hora_reco', 'hora_dev', 'groupo_vehi', 'dias_contra', 'precio_vehi', 'extras_name', 'precio_extra', 'fecha_reserva',
    'comunicaciones_comerciales', 'politica_privacidad', 'condiciones_generales'];
}
