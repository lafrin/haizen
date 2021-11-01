<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('top');
});
Auth::routes();
Route::group(['middleware' => ['auth']], function(){
   
    Route::get('/top_menu', 'TopMenuController@index')->name('menu');

    
    Route::prefix('setting')->group(function(){
        Route::get('/', 'SettingController@index')->name('setting');
        Route::get('/config', 'ConfigController@index')->name('config');

        //商品編集
        Route::prefix('category')->group(function(){
            Route::match(['get', 'post'],'/', 'CategoryController@index')->name('category');
            Route::post('/edit', 'CategoryController@edit')->name('category.edit');
            Route::get('/create_modal', 'CategoryController@showCreateModal')->name('category.create_modal');
            Route::post('/create', 'CategoryController@create')->name('category.create');
            Route::post('/delete', 'CategoryController@delete')->name('category.delete');
        });
    
        Route::match(['get', 'post'],'/item', 'MenuItemController@index' )->name('item');
        Route::get('/item/edit', 'MenuItemController@edit')->name('item.edit');
        Route::post('/item/create', 'MenuItemController@create')->name('item.create');
    });

    Route::get('/home', 'HomeController@index')->name('home');
});
