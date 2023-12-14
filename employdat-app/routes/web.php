<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatsController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserSearchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserOrderController;
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
    Route::get('/profile/order/{orderBy}', [UserOrderController::class, 'index'])->name('user.order');

    Route::get('/search', [SearchController::class, 'index'])->name('search_name');
    Route::get('/profile/search', [UserSearchController::class, 'index'])->name('user.search');
    
    Route::get('/insert',function(){return view('insert');})->name('insert');

    Route::resource('person',PersonController::class);

    Route::resource('cv',CvController::class);
    
    Route::resource('profile',ProfileController::class);  
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
