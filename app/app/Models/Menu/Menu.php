<?php

namespace Models\Menu;

use App\Http\Traits\ColumnsNameTrait;
use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{
    use ColumnsNameTrait;

    protected $table = 'menus__menu';

    protected $guarded=[];

    public function submenu()
    {
        return $this->hasMany(Submenu::class)->orderBy('orden');
    }

}
