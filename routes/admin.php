<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Master\CustomerController;
use App\Http\Controllers\Admin\Dashboard\dashboardController;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

/**
 * Dashboard
 */
Route::get('dashboard', [dashboardController::class, 'index'])->name('home');

/**
 * Master Customer
 */
Route::group(['prefix'  => '/customer'], function () {
    Route::name('customer.')->group(function () {
        Route::controller(CustomerController::class)->group(function () {
            Route::get('/list','index')->name('index');
            Route::post('/trash/{id}','trashData')->name('trash');
            Route::get('/trash','Trash')->name('trash');
            Route::post('/restore/{id}','RestoreData')->name('restore');
            Route::post('/delete/{id}','delete')->name('delete');
            Route::post('/excel','downloadExcel')->name('download');
        });
    });
});
