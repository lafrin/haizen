<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuEditController extends Controller
{
    public function index()
    {
        return view('menu/category');
    }

    public function item()
    {
        return view('menu/items');
    }
}
