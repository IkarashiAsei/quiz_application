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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
  Route::group(['prefix' => '', 'as' => 'top.'], function () {
    Route::get('/', 'App\Http\Controllers\TopController@index')->name('index');
  });
  
  Route::group(['prefix' => 'problem', 'as' => 'problem.'], function () {
    Route::get('/list', 'App\Http\Controllers\ProblemController@list')->name('list');
    Route::get('/show/{id}' , 'App\Http\Controllers\ProblemController@index')->name('index');
    Route::get('/answer/{id}/{number}', 'App\Http\Controllers\ProblemController@answer')->name('answer');
    Route::get('/create', 'App\Http\Controllers\ProblemController@create')->name('create');
    Route::get('/edit/{id}', 'App\Http\Controllers\ProblemController@edit')->name('edit');
    Route::post('/register', 'App\Http\Controllers\ProblemController@register')->name('register');
    Route::put('/update', 'App\Http\Controllers\ProblemController@update')->name('update');
    Route::delete('/destory/{id}', 'App\Http\Controllers\ProblemController@destory')->name('destory');
  });
});

require __DIR__.'/auth.php';
