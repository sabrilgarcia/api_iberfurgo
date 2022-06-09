<?php

namespace Models\Operacion;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;


class RemesaSepa extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = "operacion__remesa_sepa";

    public function estadoRemesa()
    {
        return $this->belongsTo(RemesaSepaEstado::class, 'estado_remesa_id', 'id');
    }

}
