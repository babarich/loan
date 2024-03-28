<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Borrower\BorrowerController;
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
    return Redirect::route('login');

});


Route::middleware(['auth:sanctum', 'verified'])->group(function (){
  Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});


Route::group(['middleware' => 'auth:sanctum'], function (){

    Route::group(['prefix' => 'borrower'], function (){

        Route::name('borrow.')->group(function (){
            Route::controller(BorrowerController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('export/{id?}', 'downloadAttachment')->name('download');
                Route::get('edit/{id?}', 'edit')->name('edit');
            });
        });
    });

    Route::group(['prefix' => 'groups'], function (){

        Route::name('group.')->group(function (){
            Route::controller(\App\Http\Controllers\Borrower\BorrowerGroup::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('edit/{id?}', 'edit')->name('edit');
            });
        });
    });
});
