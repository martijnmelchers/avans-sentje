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

Route::get('/home', 'HomeController@index')->name('home')->middleware(['localization']);
Route::post('/localization', 'LocalizationController@postChangeLocale')->middleware(['localization']);
Route::resource('rekeningen', 'RekeningController')->middleware(['localization', 'auth']);
Route::get('/sentje/maken', 'SentjeController@bedrag')->middleware(['localization', 'auth']);
Route::get('/sentje/overzicht', 'SentjeController@index')->middleware(['localization', 'auth']);
Route::post('/sentje/maken/titel', 'SentjeController@titel')->middleware(['localization', 'auth']);
Route::post('/sentje/maken/create', 'SentjeController@create')->middleware(['localization', 'auth']);
Route::get('/sentje/maken/delen', 'SentjeController@delen')->middleware(['localization', 'auth']);
Route::get('/rekening/{nummer}','RekeningController@details')->middleware(['localization', 'auth']);
Route::post('/gepland/opslaan', 'PlanController@store')->middleware(['localization', 'auth']);
Route::get('/gepland', 'PlanController@getPlanned')->middleware(['localization', 'auth']);