<?php

namespace Models\Soporte;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class Estado extends Model
{
    use ColumnsNameTrait;

    protected $table = "incidencias__estados";

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }

}
