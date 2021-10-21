<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopMenuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('shop_menu/menu_top');
    }
   
}
