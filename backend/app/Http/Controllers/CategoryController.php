<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\MenuCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = MenuCategory::where('user_id', Auth::id())->get();
        return view('setting/category', compact('categories'));
    }

    public function edit(Request $request){
        $category = $request->category;
        
        $cnt = count($category['name']);
        for($i=0; $i< $cnt; $i++){
            //checkboxはチェック無しの場合にpostされないので配列の数で判定している
            //チェックあり：hidden+チェック=2　　チェック無し：hiddenのみ
            $display =  count($category['display'][$i]) == 2 ? 1 : 0 ; 

            MenuCategory::updateOrCreate(
                [ 'id' => $category['id'][$i] ],
                ['color' => $category['color'][$i],
                'name' => $category['name'][$i],
                'short_name' => $category['short_name'][$i],
                'display' => $display
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