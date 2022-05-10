<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
class Oficina extends Model
{
    use ColumnsNameTrait;

    protected $table = 'maestro__oficina';

    //una oficina es de una delegacion
    public function delegacion()
    {
        return $this->hasOne(Oficina::class, 'id', 'delegacion_id');
    }
}
