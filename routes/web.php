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
})->middleware('localization');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('localization');
Route::post('/localization', 'LocalizationController@postChangeLocale')->middleware('localization');
Route::resource('rekeningen', 'RekeningController');