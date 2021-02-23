<?php

use App\Http\Controllers\BilletsController;
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

Route::get('/',[BilletsController::class, 'index'])->name('billet.index');


Route::post('/billet', [BilletsController::class, 'store'])->name('billet.store');
Route::delete('/billet/{billet}', [BilletsController::class, 'destroy'])->name('billet.destroy');
Route::get('/billet', [BilletsController::class, 'create'])->name('billet.create');