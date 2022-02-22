<?php

namespace Models\Maestro;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class FormaPago extends Model
{
    use ColumnsNameTrait;

    protected $table = 'maestro__forma_pago';

}
