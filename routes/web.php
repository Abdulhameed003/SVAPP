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
    Route::get('login','Auth\Log_inController@show')->name('log_in.show');
    Route::post('login','Auth\Log_inController@login')->name('log_in.submit');
    Route::post('logout','Auth\Log_inController@logout')->name('log_out');
    Route::get('/', function(){
        return view('auth.login');
    });
    Route::get('/dashboard', function(){
        return view('layouts.app');
    })->name('dashboard.show');
Route::prefix('api')->group(function(){
        Route::get('/dashboard', 'DashboardController@index');
        Route::resource('/project', 'ProjectController');
        Route::resource('/company', 'CompanyController');
        Route::resource('/contact', 'ContactController');
        Route::resource('/salesperson', 'SalesPersonController');
        Route::prefix('settings')->group(function() {
            Route::get('/','ConfigController@show')->name('settings.show');
            Route::post('/add','ConfigController@store')->name('settings.store');
            Route::delete('/{id}/product','ConfigController@deleteProduct')->name('delete.product');
            Route::delete('/{id}/industry','ConfigController@deleteIndustry')->name('delete.industry');
        });

});

Route::any( '{catchall}', function ( ) {
    return view('layouts.app');
} )->where('catchall', '(.*)');