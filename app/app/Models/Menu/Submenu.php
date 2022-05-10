<?php

namespace Models\Menu;

use App\Http\Traits\ColumnsNameTrait;
use Illuminate\Database\Eloquent\Model;


class Submenu extends Model
{
    use ColumnsNameTrait;

    protected $table = 'menus__submenu';

    protected $guarded=[];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

}
