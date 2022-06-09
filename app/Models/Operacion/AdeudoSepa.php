<?php

namespace Models\Operacion;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Maestro\Empresa;

class AdeudoSepa extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = "operacion__adeudo_sepa";

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'franquiciado_id', 'id');
    }

    public function adeudoSepaEstado()
    {
        return $this->belongsTo(RemesaSepa::class, 'remesa_id', 'id');
    }

}
