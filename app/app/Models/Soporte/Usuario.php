<?php

namespace Models\Soporte;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class Usuario extends Model
{
    use ColumnsNameTrait;

    protected $table = "users";

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
