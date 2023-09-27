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
    Route::get('/', [StockController::class, 'stock'])->name('stock');
    Route::post('/', [StockController::class, 'sorted']);
    Route::get('/add', [StockController::class, 'registration']);
    Route::post('/add', [StockController::class, 'store']);
    Route::get('/out', [StockController::class, 'out']);
    Route::post('/out', [StockController::class, 'update']);
    Route::get('/commandes', [StockController::class, 'commandes'])->name('commandes');
    Route::post('/commandes', [StockController::class, 'commandeStore']);
    Route::get('/commandes.sorted', [StockController::class, 'commandesSorted']);
    Route::get('/commande/{id}/show', [StockController::class, 'commandeShow'])->name('details');
    Route::get('/history', [StockController::class, 'history']);
    Route::post('/history', [StockController::class, 'sort']);
    Route::get('/deconnection', [MonController::class, 'deconnexion']);
});

Route::middleware(['guest'])->group(function (){
    Route::get('/login', [MonController::class, 'login'])->name('login');
    Route::get('/registration', [MonController::class, 'registration']);
    Route::post('/registration', [MonController::class, 'registratrer']);
    Route::post('/loger', [MonController::class, 'loger']);
});

// Route::middleware(['auth'])->group(function (){
//     Route::get('/', [MonController::class, 'show']);
// });