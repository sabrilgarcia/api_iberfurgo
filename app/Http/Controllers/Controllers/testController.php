<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends ApiController
{
    public function index(Request $request){
        dd('entra');
    }
}
