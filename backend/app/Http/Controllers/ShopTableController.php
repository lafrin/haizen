<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ShopTable;

class ShopTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = ShopTable::where('shop_id', Auth::id())->get();
        $title = "テーブル登録";
        return view('setting/shop_table', compact('tables', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //419エラーの場合は3000でアクセスしているから
        $table = ShopTable::create([
            'shop_id' => Auth::id(),
            'table_name' => $request->name,
            'status' => 0,
            'max_people' => $request->people,
            'is_display' => 0
        ]);

        $table->id_hash = \Hash::make($table->id);
        $table->save();

        return redirect()->route('table');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\shopTable  $shopTable
     * @return \Illuminate\Http\Response
     */
    public function show(shopTable $shopTable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\shopTable  $shopTable
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        // $validate = array();
        // $error_text = array();
        // foreach($request->item_id as $id){
        //     $validate += array('name_'.$id => 'required');
        //     $validate += array('price_'.$id => 'integer|nullable');
        //     $error_text += array("name_$id.required" => '商品名は必須です');
        //     $error_text += array("price_$id.integer" => '数値を入力してください');
        // }
        
        // $request->validate(
        //     $validate,
        //     $error_text
        // );
        $req_array = $request->toarray();
        foreach($req_array['item_id'] as $id){
            $display =  isset( $req_array["display_$id"] ) ? 1 : 0 ; 
            ShopTable::updateOrCreate(
                [ 'id' => $id ],
                [
                    'table_name' => $req_array["name_$id"],
                    'max_people' => $req_array["people_$id"],
                    'is_display' => $display,
                ]
            );
        }

        session()->flash('flash_msg','保存しました');
        return redirect( route('table') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\shopTable  $shopTable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, shopTable $shopTable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\shopTable  $shopTable
     * @return \Illuminate\Http\Response
     */
    public function destroy(shopTable $shopTable)
    {
        //
    }
}
