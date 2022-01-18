<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

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
}
