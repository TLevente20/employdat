<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatsController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/', [PersonController::class, 'index'])->name('home');
    Route::get('/home', [PersonController::class, 'index']);

    Route::get('/order/{orderBy}', [OrderController::class, 'index'])->name('order');

    Route::get('/search', [SearchController::class, 'index'])->name('search_name');
    
    Route::get('/insert',function(){return view('insert');})->name('insert');

    Route::resource('person',PersonController::class);

    Route::resource('cv',CvController::class);    
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('profile',ProfileController::class);  
});

require __DIR__.'/auth.php';
