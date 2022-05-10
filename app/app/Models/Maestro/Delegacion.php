<?php

namespace Models\Maestro;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

use Models\Maestro\Empresa;
use Models\Ofertas\Oferta;
use Models\Soporte\Ticket;

class Delegacion extends Model
{
    use ColumnsNameTrait;

    protected $table = 'maestro__delegacion';

    //posee varias oficinas
    public function oficinas()
    {
        return $this->belongsTo(Oficina::class, 'delegacion_id');
    }

    public function delegacionDatosWeb()
    {
        return $this->hasOne(DelegacionDatosWeb::class, 'delegacion_id', 'id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ofertas()
    {
        return $this->hasMany(Oferta::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
