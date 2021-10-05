<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class shopMenuController extends Controller
{
    
    public function index()
    {
        return view('shop_menu/menu_top');
    }
   
}
