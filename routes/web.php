<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Front\CekoutController;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\Front\DetailController;
use App\Http\Controllers\Front\PaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('front.')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('index');
    Route::get('/detail/{slug}', [DetailController::class, 'index'])->name('detail');

    Route::get('/payment/success', [PaymentController::class, 'successs'])->name('payment.success');
    
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/cekout/{slug}', [CekoutController::class, 'index'])->name('cekout');
        Route::post('/cekout/{slug}', [CekoutController::class, 'store'])->name('cekout.store');
        
        Route::get('/payment/{bookingId}', [PaymentController::class, 'index'])->name('payment');
        Route::post('/payment/{bookingId}', [PaymentController::class, 'update'])->name('payment.update');
    });
});

Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'This.Admin',

])->group(function () {

    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::resource('brand', BrandController::class);
    Route::resource('type', TypeController::class);
    Route::resource('item', ItemController::class);
    Route::resource('booking', BookingController::class);
});
