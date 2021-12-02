<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Storage;

class ItemController extends Controller
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
        $items = MenuItem::where('user_id', Auth::id())->get();
        $title = "アイテム登録";
        $cat_list = MenuCategory::selectList();
        return view('setting/item', compact('categories', 'items', 'title', 'cat_list'));
    }

    public function edit(Request $request){
        // dd($request->all());
        $validate = array();
        $error_text = array();
        foreach($request->item_id as $id){
            $validate += array('name_'.$id => 'required');
            $validate += array('price_'.$id => 'integer|nullable');
            $error_text += array("name_$id.required" => '商品名は必須です');
            $error_text += array("price_$id.integer" => '数値を入力してください');
        }
        
        $request->validate(
            $validate,
            $error_text
        );
        $req_array = $request->toarray();
        
        foreach($req_array['item_id'] as $id){
            //checkboxはチェック無しの場合にpostされないので配列の数で判定している
            //チェックあり：hidden+チェック=2　　チェック無し：hiddenのみ=1
            $display =  isset( $req_array["display_$id"] ) ? 1 : 0 ; 

            MenuItem::updateOrCreate(
                [ 'id' => $id ],
                ['category_id' => $req_array["category_id_$id"],
                'name' => $req_array["name_$id"],
                'price' => $req_array["price_$id"],
                'display' => $display,
                ]
            );
        }

        session()->flash('flash_msg','保存しました');
        return redirect( route('item') );
    }

    public function create(Request $request)
    {
        //419エラーの場合は3000でアクセスしているから
        $image = $request->file('images');
        if($image){
            //putFile(フォルダパス,　画像file,　publicにすると公開設定（無くていい）)
            $path = Storage::disk('s3')->putFile('/food', $image, 'public');
            $path = Storage::disk('s3')->url($path);
        }else{
            $path = null;
        }
        $category = MenuItem::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'image_path' => $path
        ]);
        
        return redirect()->route('item');
    }
}
