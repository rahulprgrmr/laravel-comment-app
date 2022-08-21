<?php

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

Route::prefix('admin')->group(function () {
    Route::get('/login', [\App\Http\Controllers\AdminController::class, 'showLoginForm'])->middleware(['guest']);
    Route::post('/login', [\App\Http\Controllers\AdminController::class, 'authenticate'])->middleware(['guest']);
    Route::get('/comments', [\App\Http\Controllers\AdminController::class, 'comments'])->middleware(['auth']);
    Route::get('/comments/add', [\App\Http\Controllers\AdminController::class, 'create_comments'])->middleware(['auth']);
    Route::post('/comments', [\App\Http\Controllers\AdminController::class, 'store_comments'])->middleware(['auth']);
});

Route::get('/login', [\App\Http\Controllers\CustomerController::class, 'showLoginForm'])->name('login')->middleware(['guest']);
Route::post('/login', [\App\Http\Controllers\CustomerController::class, 'authenticate'])->middleware(['guest']);
Route::get('/comments', [\App\Http\Controllers\CustomerController::class, 'comments'])->middleware(['customer']);
Route::get('/comments/add', [\App\Http\Controllers\CustomerController::class, 'create_comments'])->middleware(['customer']);
Route::post('/comments', [\App\Http\Controllers\CustomerController::class, 'store_comments'])->middleware(['customer']);

Route::get('/logout', [\App\Http\Controllers\HomeController::class, 'logout']);


