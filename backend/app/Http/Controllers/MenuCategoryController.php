<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\MenuCategory;

class MenuCategoryController extends Controller
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
        $categories = MenuCategory::where('user_id', Auth::id())->get();
        return view('menu/category', compact('categories'));
    }

    public function edit(Request $request){
        dd($request->all());
        // MenuCategory::updateOrCreate(
        //     ['user_id' => $request->]
        // );
    }

    public function createModal()
    {
        $title = "カテゴリー登録";
        return view('modal/category', compact('title') );
    }

    public function create(Request $request)
    {
        $category = MenuCategory::create([
            'user_id' => Auth::id(),
            'color' => '#ff33f3',
            'name' => $request->category_name,
            'short_name' => $request->category_short
        ]);
        
        return redirect()->route('menu_cat');
    }

}
