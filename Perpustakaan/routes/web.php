<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
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
    return view('welcome');
});

//Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard-index');

Route::group(['middleware' => 'auth'], function() {
    Route::get("/redirectAuthenticatedUsers", [RedirectAuthenticatedUsersController::class, "home"]);

    //Admin
    Route::group(['middleware' => 'checkRole:admin'], function() {
        Route::get('/adminDashboard', [DashboardController::class, 'indexAdm'])->name('dashboard-index');
        
        // category
        Route::group(['prefix' => 'category', 'as' => 'category.'], function(){
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/input-form', [CategoryController::class, 'showInputForm'])->name('input-data');
            Route::post('/store', [CategoryController::class, 'store'])->name('store-data');
            Route::get('/edit/{id}', [CategoryController::class, 'showEditForm'])->name('edit-form');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update-data');
            Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('delete-data');
        });
        
        // book
        Route::group(['prefix' => 'book', 'as' => 'book.'], function(){
            Route::get('/', [BookController::class, 'index'])->name('index');
            Route::get('/input-form', [BookController::class, 'showInputForm'])->name('input-data');
            Route::post('/store', [BookController::class, 'store'])->name('store-data');
            Route:: get('/detail/{id}', [BookController::class, 'detail'])->name('detail-data');
            Route::get('/edit/{id}', [BookController::class, 'showEditForm'])->name('edit-form');
            Route::post('/update/{id}', [BookController::class, 'update'])->name('update-data');
            Route::delete('/delete/{id}', [BookController::class, 'destroy'])->name('delete-data');
        });
    });
    
    //User
    Route::group(['middleware' => 'checkRole:user'], function() {
        Route::get('/userDashboard', [DashboardController::class, 'indexUser'])->name('dashboard-index');
        Route::group(['prefix' => 'book', 'as' => 'book.'], function(){
            Route::get('/', [BookController::class, 'index'])->name('index');
            Route:: get('/detail/{id}', [BookController::class, 'detail'])->name('detail-data');
        });
    });
    
    //Guest
    Route::group(['middleware' => 'checkRole:guest'], function() {
       // Route::get('/', '')->name('');
    });
});




 
require __DIR__.'/auth.php';