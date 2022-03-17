<?php

namespace Models\Flota;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;



class VersionCaracteristicas extends Model
{
    use ColumnsNameTrait;

    protected $table = 'flota__version_caracteristicas';

    protected $guarded=[];

    public $timestamps = false;

    public function version(){
        return $this->belongsTo(Version::class,'id', 'id');
    }

}
