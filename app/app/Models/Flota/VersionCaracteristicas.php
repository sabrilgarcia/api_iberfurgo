<?php

namespace Models\Flota;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Models\Combustible\Combustible;

class VersionCaracteristicas extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__version_caracteristicas';

    protected $guarded=[];

    public $timestamps = false;

    public function combustible(){
        return $this->belongsTo(Combustible::class);
    }

}
