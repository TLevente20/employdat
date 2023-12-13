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
    Route::post('/', [PersonController::class, 'store'])->name('add_row');
    Route::get('/edit{id}',[PersonController::class,'edit'])->name('edit');
    Route::patch('/{id}',[PersonController::class,'update'])->name('update');
    Route::get('/destroy{id}',[PersonController::class,'destroy'])->name('remove_row');


    Route::get('/cv{id}',[CvController::class,'index'])->name('cvs');
    Route::post('/cv{id}', [CvController::class,'create'])->name('add_cv');
    Route::get('/cv/{id}/{id_cv}', [CvController::class,'destroy'])->name('remove_cv');
    Route::patch('/cv/{id}/{id_cv}', [CvController::class,'update'])->name('update_cv');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
