<?php

use App\Http\Controllers\Borrower\BorrowerController;
use App\Http\Controllers\Borrower\BorrowerGroup;
use App\Http\Controllers\Borrower\GuarantorController;
use App\Http\Controllers\Loan\ProductController;
use App\Http\Controllers\Loan\LoanController;
use App\Http\Controllers\Collateral\CollateralTypeController;
use App\Http\Controllers\Collateral\CollateralController;
use Illuminate\Support\Facades\Redirect;
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


    Route::group(['prefix' => 'loans'], function (){

        Route::name('loan.')->group(function (){
            Route::controller(LoanController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::post('attachment/{id?}', 'attachment')->name('attachment');
                Route::get('export/{id?}', 'downloadAttachment')->name('download');
                Route::get('edit/{id?}', 'edit')->name('edit');
            });
        });
    });

    Route::group(['prefix' => 'guarantors'], function (){

        Route::name('guarantor.')->group(function (){
            Route::controller(GuarantorController::class)->group(function (){
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
            Route::controller(BorrowerGroup::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('edit/{id?}', 'edit')->name('edit');
            });
        });
    });




    Route::group(['prefix' => 'collaterals'], function (){

        Route::name('collateral.')->group(function (){
            Route::controller(CollateralController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store/{id?}', 'store')->name('store');
                Route::get('download/{id?}', 'downloadAttachment')->name('download');
                Route::get('file_download/{id?}', 'downloadFile')->name('downloadFile');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('attachment_file/{id?}', 'attachment')->name('attach');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('edit/{id?}', 'edit')->name('edit');
            });
        });
    });


    Route::group(['prefix' => 'collateraltypes'], function (){

        Route::name('collateraltype.')->group(function (){
            Route::controller(CollateralTypeController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('edit/{id?}', 'edit')->name('edit');
            });
        });
    });

    Route::group(['prefix' => 'products'], function (){

        Route::name('product.')->group(function (){
            Route::controller(ProductController::class)->group(function (){
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
