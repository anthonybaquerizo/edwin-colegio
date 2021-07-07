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

    Route::prefix('student')->group(function() {

        Route::put('update', 'Panel\\UserController@update');

        Route::post('change_photo', 'Panel\\UserController@changePhoto');

        Route::get('courses', 'Panel\\UserController@courses')
            ->name('user.courses');

        Route::get('course/{userId}', 'Panel\\UserCourseController@course')
            ->name('course.user');
        Route::post('course/store/{userId}', 'Panel\\UserCourseController@store')
            ->name('course.user.store');
        Route::get('course/show/{courseId}', 'Panel\\UserCourseController@show')
            ->name('course.user.show');
        Route::get('course/hour/{courseId}', 'Panel\\UserCourseController@hour')
            ->name('course.user.hour');
    });

    Route::prefix('teacher')->group(function() {

        Route::get('courses', 'Panel\\TeacherCourseController@courses')
            ->name('teacher.courses');
        Route::get('assistance/{courseId}', 'Panel\\TeacherCourseController@assistance')
            ->name('teacher.courses.assistance');
        Route::post('assistance/save', 'Panel\\TeacherCourseController@saveAssistance')
            ->name('teacher.courses.assistance.save');
        Route::get('resource/{courseId}', 'Panel\\TeacherCourseController@resource')
            ->name('teacher.courses.resource');
        Route::post('resource/save', 'Panel\\TeacherCourseController@saveResource')
            ->name('teacher.courses.resource.save');
        Route::post('resource/delete/{resourceId}', 'Panel\\TeacherCourseController@deleteResource')
            ->name('teacher.courses.resource.delete');
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
            Route::post('update/{id}', 'Panel\\Admin\\CourseController@update')
                ->name('admin.course.update');
        });
    });
});
