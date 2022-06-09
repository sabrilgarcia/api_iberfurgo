<?php

namespace Models\Operacion;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Maestro\Empresa;

class AdeudoSepaEstado extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    protected $table = "operacion__adeudos_estados_sepa";

    

}
