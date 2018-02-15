<?php
use Illuminate\Support\Facades\Auth;
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


Route::get('/', function(){
    return view('auth.login');
});

Auth::routes();
Route::get('login','Auth\Log_inController@show')->name('log_in.show');
Route::post('login','Auth\Log_inController@login')->name('log_in.submit');
Route::post('logout','Auth\Log_inController@logout')->name('log_out');

Route::middleware(['auth'])->group(function(){
    route::get('/dashboard', function(){
        return view('layouts.app');
    })->name('dashboard.show');
    route::get('/project', function(){
        return view('layouts.app');
    });
    route::get('/company', function(){
        return view('layouts.app');
    });
    route::get('/contact', function(){
        return view('layouts.app');
    });
    route::get('/sales', function(){
        return view('layouts.app');
    });
});

Route::middleware(['ajax'])->prefix('api')->group(function(){
        Route::get('/dashboard', 'DashboardController@index');
        Route::resource('/project', 'ProjectController',['except'=>['edit']]);
        Route::resource('/company', 'CompanyController',['except'=>['edit']]);
        Route::resource('/contact', 'ContactController',['except'=>['edit']]);
        Route::resource('/salesperson', 'SalesPersonController',['except'=>['edit']]);
        Route::prefix('settings')->group(function() {
            Route::get('/','ConfigController@show')->name('settings.show');
            Route::post('/add','ConfigController@store')->name('settings.store');
            Route::delete('/{id}/product','ConfigController@deleteProduct')->name('delete.product');
            Route::delete('/{id}/industry','ConfigController@deleteIndustry')->name('delete.industry');
        });

});

Route::any( '{catchall}', function ( ) {
    if (Auth::check()) {
       return redirect('/dashboard');
    }elseif(Auth::guest()){
        return redirect('/login');
    }
} )->where('catchall', '(.*)');