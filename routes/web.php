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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/home/submit','HomeController@submit');

Route::post('/home/withdraw','WithdrawController@withdraw');

Route::post('/home/cash','CashController@cash');

Route::get('/home', 'HomeController@index')->name('home');
