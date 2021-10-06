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
Route::get('/menu_edit', 'MenuEditController@index')->name('menu');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
