<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\MenuItem;
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
        $categories = MenuItem::where('user_id', Auth::id())->get();
        return view('menu/item', compact('categories'));
    }

    public function edit()
    {
        $title = "アイテム登録";
        return view('modal/item', compact('title') );
    }
    public function create(Request $request)
    {
        $post = new MenuItem;
        $image = $request->file('images');
        //putFile(フォルダパス,　画像file,　publicにすると公開設定（無くていい）)
        $path = Storage::disk('s3')->putFile('food', $image, 'public');
        $post->user_id = 1;
        $post->sort_order = 1;
        $post->name = "namename";
        $post->category_id = 1;
        $post->price = "100";
        $post->image_path = Storage::disk('s3')->url($path);
        $post->save();
        // dd($request->images);
        // $category = MenuCategory::create([
        //     'user_id' => Auth::id(),
        //     'color' => 'ff33f3',
        //     'name' => $request->category_name,
        //     'short_name' => $request->category_short
        // ]);
        
        return redirect()->route('item');
    }
}
