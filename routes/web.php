<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('panel')->group(function() {

    Route::prefix('user')->group(function() {

        Route::put('update', 'Panel\\UserController@update');

        Route::post('change_photo', 'Panel\\UserController@changePhoto');

    });

});
