<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class Provincia extends Model
{
    use ColumnsNameTrait;

    protected $table = 'maestro__provincia';
}
