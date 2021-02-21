<?php

use App\Http\Controllers\SandBoxController;
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

Route::get('/',[SandBoxController::class, 'index'])->name('billet.index');


Route::post('/billet', [SandBoxController::class, 'store'])->name('billet.store');
Route::delete('/billet/{billet}', [SandBoxController::class, 'destroy'])->name('billet.destroy');
Route::get('/billet', [SandBoxController::class, 'create'])->name('billet.create');