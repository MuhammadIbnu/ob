<?php

use Illuminate\Support\Facades\Route;


Route::get('login', 'Auth\LoginController@showFormLogin')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::prefix('admin')->group(function(){
    Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('admin.dashboard');

    //Route Upload Image Admin
    Route::prefix('upload')->group(function() {
        Route::get('/', 'Admin\ImageController@index')->name('admin.upload.index');
        Route::get('/show/{id}', 'Admin\ImageController@show')->name('admin.upload.show');
    });

    Route::prefix('task')->group(function() {
        Route::get('/{state}', 'Admin\TaskController@index')->name('admin.task.index');
        Route::get('/{state}/create', 'Admin\TaskController@create')->name('admin.task.create');
        Route::post('/create', 'Admin\TaskController@store')->name('admin.task.post');
        Route::get('/{task:id}/edit', 'Admin\TaskController@edit')->name('admin.task.edit');
        Route::put('/{task:id}/edit', 'Admin\TaskController@update');
        Route::delete('/{task:id}/delete', 'Admin\TaskController@destroy')->name('admin.task.delete');
    });

    Route::prefix('verif')->group(function(){
        Route::get('/{state}', 'Admin\VerifController@index')->name('admin.verif.index');
        Route::get('/{state}/{verif:id}/pdf', 'Admin\VerifController@pdf')->name('admin.verif.pdf');
    });

    Route::prefix('message')->group(function() {
        Route::get('/', 'Admin\MessageController@index')->name('admin.message.index');
        Route::post('/update', 'Admin\MessageController@update')->name('admin.message.update');
    });

    Route::prefix('schedulle')->group(function() {
        Route::get('/', 'Admin\SchedulleController@index')->name('admin.schedulle.index');

        Route::get('/create', 'Admin\SchedulleController@create')->name('admin.schedulle.create');

        Route::post('/create', 'Admin\SchedulleController@store');

        Route::get('/{schedulle:id}/edit', 'Admin\SchedulleController@edit')->name('admin.schedulle.edit');

        Route::put('/{schedulle:id}/edit', 'Admin\SchedulleController@update');

        Route::delete('/{schedulle:id}/delete', 'Admin\SchedulleController@destroy')->name('admin.schedulle.delete');
    });

    Route::prefix('office-boy')->group(function() {
        Route::get('/', 'Admin\OBController@index')->name('admin.ob.index');

        Route::get('/create', 'Admin\OBController@create')->name('admin.ob.create');

        Route::post('/create', 'Admin\OBController@store');

        Route::get('/{user:id}/edit', 'Admin\OBController@edit')->name('admin.ob.edit');

        Route::put('/{user:id}/edit', 'Admin\OBController@update');

        Route::delete('/{user:id}/delete', 'Admin\OBController@destroy')->name('admin.ob.destroy');
    });
});

Route::prefix('office-boy')->group(function(){

    Route::get('dashboard', 'OB\DashboardController@dashboard')->name('ob.dashboard');

    Route::prefix('task')->group(function(){
        Route::get('{state}', 'OB\TaskOneController@index')->name('ob.taks.index');

        Route::get('{state}/data', 'OB\TaskOneController@getData');

        Route::post('clear', 'OB\TaskOneController@clear')->name('task.clear');
    });

    Route::get('schedulle', 'OB\schedulleController@index')->name('ob.schedulle.index');

    Route::prefix('message')->group( function() {
        Route::get('/', 'OB\MessageController@index')->name('ob.mesage.index');

        Route::put('update', 'OB\MessageController@update')->name('ob.mesage.update');
    });

    //Route Upload Image OB Indoor & Outdoor
    Route::prefix('upload')->group(function(){
        Route::get('/', 'OB\ImageController@index')->name('ob.upload.index');
        Route::get('/create', 'OB\ImageController@create')->name('ob.upload.create');
        Route::post('/store', 'OB\ImageController@store')->name('ob.upload.store');
        Route::get('/edit/{id}', 'OB\ImageController@edit')->name('ob.upload.edit');
        Route::post('/update/{id}', 'OB\ImageController@update')->name('ob.upload.update');
        Route::get('/destroy/{id}', 'OB\ImageController@destroy')->name('ob.upload.destroy');
    });

});


Route::get('/home', 'HomeController@index')->name('home');
