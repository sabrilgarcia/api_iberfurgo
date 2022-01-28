<?php

namespace Models\Maestro;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Soporte\Ticket;

class DelegacionIndice extends Model
{
    use ColumnsNameTrait;

    protected $table = 'maestro__delegacion_indices';

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
