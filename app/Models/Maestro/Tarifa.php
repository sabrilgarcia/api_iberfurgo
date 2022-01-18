<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ColumnsNameTrait;
use Illuminate\Validation\Rule;


class Tarifa extends Model
{
    use ColumnsNameTrait;

    protected $table = 'maestro__tarifa';

    protected $appends = ['tipoFlota', 'nombreDelegacion'];

    const IVA = 1.21;

    public static function rules() {
        return [
            'tipo_tarifa' =>  [
                'required',
                Rule::in(['DAY', 'HOUR']),
            ],
            'fecha_inicio' => 'required|date_format:Y-m-d H:i|before:fecha_fin',
            'fecha_fin' => 'required|date_format:Y-m-d H:i',
            'delegacion_id' => 'required|integer|min:1'
        ];
    }

    public function getTipoFlotaAttribute()
    {
        return Tipo::find($this->attributes['tipo_id']);
    }

    public function getNombreDelegacionAttribute()
    {
        return Delegacion::find($this->attributes['delegacion_id'])->nombre;
    }
}
