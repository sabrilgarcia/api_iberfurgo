<?php

namespace Models\Contacto;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;

class Contacto extends Model
{
    use ColumnsNameTrait;

    protected $table = 'contacto__web';

    protected $fillable = ['nombre', 'email', 'telefono', 'delegacion', 'asunto', 'comentario'];
}
