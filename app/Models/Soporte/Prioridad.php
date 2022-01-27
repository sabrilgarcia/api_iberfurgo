<?php

namespace Models\Soporte;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class Prioridad extends Model
{
    use ColumnsNameTrait;

    protected $table = "incidencias__prioridad";

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
