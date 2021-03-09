<?php

use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\DashboardPageController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\TransactionPageController;
use App\Http\Controllers\UserPageController;
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
    return redirect()->route('admin-dashboard');
});


// Dashboard
Route::prefix('dashboard')
    ->middleware(['auth:sanctum','admin'])
    ->group(function() {
        Route::get('/', [DashboardPageController::class, 'index'])
            ->name('admin-dashboard');
        Route::resource('product', ProductPageController::class);
        Route::resource('users', UserPageController::class);

        Route::get('transactions/{id}/status/{status}', [TransactionPageController::class, 'changeStatus'])
            ->name('transactions.changeStatus');
        Route::resource('transactions', TransactionPageController::class);
    });

// Midtrans Related
Route::get('midtrans/success', [MidtransController::class, 'success']);
Route::get('midtrans/unfinish', [MidtransController::class, 'unfinish']);
Route::get('midtrans/error', [MidtransController::class, 'error']);