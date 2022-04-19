<?php

namespace Models\Maestro;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Maestro\Empresa;

class Banco extends Model
{
    use ColumnsNameTrait;

    protected $table = 'maestro__banco';

}
