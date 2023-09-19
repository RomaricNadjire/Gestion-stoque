<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonController;
use App\Http\Controllers\StockController;

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
Route::middleware(['auth'])->group(function (){    
    Route::get('/', [StockController::class, 'stock']);
    Route::get('add', [StockController::class, 'registration']);
    Route::get('out', [StockController::class, 'out']);
    Route::get('commandes', [StockController::class, 'commandes']);
});

Route::middleware(['guest'])->group(function (){
    Route::get('login', [MonController::class, 'login'])->name('login');
    Route::get('registration', [MonController::class, 'registration']);
    Route::post('registration', [MonController::class, 'registrater']);
    Route::post('loger', [MonController::class, 'loger']);
});

// Route::middleware(['auth'])->group(function (){
//     Route::get('/', [MonController::class, 'show']);
// });