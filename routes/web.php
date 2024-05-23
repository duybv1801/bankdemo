<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ApproveController;
use App\Models\Bill;
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

Route::middleware(['auth'])->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');
    Route::get('/query', [QueryController::class, 'index'])->name('query');
    Route::get('/transfer', [TransferController::class, 'index'])->name('transfer.index')->can('create', Bill::class);
    Route::post('/transfer', [TransferController::class, 'store'])->name('transfer.store')->can('create', Bill::class);
    Route::get('/bill', [ApproveController::class, 'index'])->name('approve.index')->can('update', Bill::class);
    Route::get('/bill/{id}', [ApproveController::class, 'edit'])->name('approve.edit')->can('update', Bill::class);;
    Route::put('bill/{id}', [ApproveController::class, 'update'])->name('approve.update')->can('update', Bill::class);;

    Route::get('/ajax/receiver', [AjaxController::class, 'receiver'])->name('ajax.receiver');
    Route::post('/ajax/send-otp', [AjaxController::class, 'sendOtp'])->name('ajax.sendOtp');
    Route::post('/ajax/verify-otp', [AjaxController::class, 'verifyOtp'])->name('ajax.verifyOtp');
});

require __DIR__.'/auth.php';
