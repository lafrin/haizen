<?php

namespace App\Http\Controllers;

use App\Models\ShopTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'ホール';
        $tables = ShopTable::where('shop_id', Auth::id())
        ->where('is_display', 1)->get();
        $categories = ['possible'=>'可能','use'=>'使用','bill'=>'清算','cleaning'=>'清掃'];
        return view('hall/hall', compact('title', 'tables', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function show(Hall $hall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function edit(Hall $hall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function updateEnable(Request $request)
    {
        $table = ShopTable::where('id',$request->id)->first();
        $table->people = $request->people;
        $table->status = $request->status;

        if($request->action === 'use'){
            $table->setUse();
        }
        if($request->action === 'enable'){
            $table->setEnable();
        }
        if($request->action === 'disable'){
            $table->setDisable();
        }
        return $table->getTableData($request->action);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall)
    {
        //
    }
}
