<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MenuCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = MenuCategory::where('user_id', Auth::id())->get();
        // dd($categories);
        return view('setting/category', compact('categories'));
    }

    public function edit(Request $request){
        $category = $request->category;
        
        $cnt = count($category['name']);
        for($i=0; $i< $cnt; $i++){
            $display =  isset( $category['display'][$i] ) ? 1 : 0 ; 

            MenuCategory::updateOrCreate(
                [ 'id' => $category['id'][$i] ],
                ['color' => $category['color'][$i],
                'name' => $category['name'][$i],
                'short_name' => $category['short_name'][$i],
                'is_display' => $display
                ]
            );
        }

        session()->flash('flash_msg','保存しました');
        return redirect( route('category') );
    }

    public function showCreateModal()
    {
        $title = "カテゴリー登録";
        return view('modal/category', compact('title') );
    }

    public function create(Request $request)
    {
        //419エラーの場合は3000でアクセスしているから
        $category = MenuCategory::create([
            'user_id' => Auth::id(),
            'color' => '#ffffff',
            'name' => $request->category_name,
            'short_name' => $request->category_short
        ]);
        
        return redirect()->route('category');
    }

    public function delete(Request $request){
        $user_id = Auth::id();
        MenuCategory::where('user_id',Auth::id())
        ->where('id',$request->input('category_id'))
        ->delete();

        return $request->input('category_id');
    }

}
