<?php

namespace Models\Maestro;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;



class ProvinciaDatosWeb extends Model
{
    use ColumnsNameTrait;

    protected $table = 'maestro__provincia_datos_web';

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function delegacionDatosWeb()
    {
        return $this->hasMany(DelegacionDatosWeb::class, 'provincia_id', 'provincia_id');
    }
    
}
