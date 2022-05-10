<?php

namespace Models\Maestro;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;


class Empresa extends Model
{
    use ColumnsNameTrait;

    protected $table = 'maestro__empresa';


    public function delegaciones()
    {
        return $this->hasMany(Delegacion::class);
    }
}
