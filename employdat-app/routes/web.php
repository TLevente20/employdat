<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dats_controller;
use App\Http\Controllers\dats_cv_controller;

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
Route::get('/', [dats_controller::class, 'index'])->name('home');
Route::get('/order/name', [dats_controller::class, 'orderName'])->name('order_name');
Route::get('/order/email', [dats_controller::class, 'orderEmail'])->name('order_email');
Route::get('/order/post', [dats_controller::class, 'orderPost'])->name('order_post');
Route::get('/search', [dats_controller::class, 'search'])->name('search_name');
Route::get('/insert',function(){return view('insert');})->name('insert');
Route::post('/', [dats_controller::class, 'store'])->name('add_row');
Route::delete('/{id}',[dats_controller::class,'delete'])->name('remove_row');
Route::get('/confirm{id}',[dats_controller::class,'confirm'])->name('delete_confirm');
Route::get('/edit{id}',[dats_controller::class,'edit'])->name('edit');
Route::patch('/{id}',[dats_controller::class,'update'])->name('update');


Route::get('/cv{id}',[dats_cv_controller::class,'index'])->name('cvs');
Route::post('/cv{id}', [dats_cv_controller::class,'create'])->name('add_cv');
Route::get('/cv/{id}/{id_cv}', [dats_cv_controller::class,'delete'])->name('remove_cv');
Route::patch('/cv/{id}/{id_cv}', [dats_cv_controller::class,'update'])->name('update_cv');
