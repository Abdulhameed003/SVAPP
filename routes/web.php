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



Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::get('login','Auth\Log_inController@show')->name('log_in.show');
Route::post('login','Auth\Log_inController@login')->name('log_in.submit');