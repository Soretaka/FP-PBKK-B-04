<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
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

// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard-index');

// category
Route::group(['prefix' => 'category', 'as' => 'category.'], function(){
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/input-form', [CategoryController::class, 'showInputForm'])->name('input-data');
    Route::post('/store', [CategoryController::class, 'store'])->name('store-data');
    Route::get('/edit/{id}', [CategoryController::class, 'showEditForm'])->name('edit-form');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update-data');
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('delete-data');
});