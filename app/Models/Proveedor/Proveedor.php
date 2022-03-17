<?php

namespace Models\Proveedor;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Delegacion;

class Proveedor extends Model
{
    use ColumnsNameTrait;

    protected $guarded = [];

    public $timestamps = false;

    protected $table = 'proveedor__proveedor';

    public function tipoProveedor()
    {
        return $this->belongsTo(tipoProveedor::class);
    }

    public function delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }

}
