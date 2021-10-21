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
    return view('shop_top');
});

Route::get('/shop_menu', 'ShopMenuController@index')->name('menu');

//商品編集
Route::match(['get', 'post'],'/menu_category', 'MenuEditController@index')->name('menu_cat');
Route::get('/menu_category/edit', 'MenuEditController@edit')->name('menu_cat.edit');
Route::post('/menu_category/create', 'MenuEditController@create')->name('menu_cat.create');

Route::match(['get', 'post'],'/menu_item', 'MenuItemController@index' )->name('menu_item');
Route::get('/menu_item/edit', 'MenuItemController@edit')->name('menu_item.edit');
Route::post('/menu_item/create', 'MenuItemController@create')->name('menu_item.create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
