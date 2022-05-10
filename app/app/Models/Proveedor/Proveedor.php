<?php

namespace Models\Proveedor;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Maestro\Delegacion;

class Proveedor extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    public $timestamps = false;

    protected $table = 'proveedor__proveedor';

    public function tipoProveedor()
    {
        return $this->belongsTo(TipoProveedor::class);
    }

    public function delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }

}
