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

        Route::get('courses', 'Panel\\UserController@courses')
            ->name('user.courses');

        Route::get('course/{userId}', 'Panel\\UserCourseController@course')
            ->name('course.user');
        Route::post('course/store/{userId}', 'Panel\\UserCourseController@store')
            ->name('course.user.store');
    });

    Route::prefix('admin')->group(function() {

        Route::prefix('user')->group(function() {

            Route::get('index/{type}', 'Panel\\Admin\\UserController@index')
                ->name('admin.user.index');
            Route::get('create/{type}', 'Panel\\Admin\\UserController@create')
                ->name('admin.user.create');
            Route::get('edit/{id}', 'Panel\\Admin\\UserController@edit')
                ->name('admin.user.edit');
            Route::post('store', 'Panel\\Admin\\UserController@store')
                ->name('admin.user.store');
            Route::post('update/{id}', 'Panel\\Admin\\UserController@update')
                ->name('admin.user.update');
            Route::delete('delete/{id}', 'Panel\\Admin\\UserController@delete')
                ->name('admin.user.delete');
        });
        Route::prefix('course')->group(function() {

            Route::get('index', 'Panel\\Admin\\CourseController@index')
                ->name('admin.course.index');
             Route::get('show/{id}', 'Panel\\Admin\\CourseController@show')
                ->name('admin.course.show');
            Route::get('create', 'Panel\\Admin\\CourseController@create')
                ->name('admin.course.create');
            Route::post('store', 'Panel\\Admin\\CourseController@store')
                ->name('admin.course.store');
            Route::get('edit/{id}', 'Panel\\Admin\\CourseController@edit')
                ->name('admin.course.edit');
            Route::put('update/{id}', 'Panel\\Admin\\CourseController@update')
                ->name('admin.course.update');
        });
    });
});
