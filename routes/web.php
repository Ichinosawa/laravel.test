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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'showList'])->name('product');
Route::post('/delete{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('product.destroy');
Route::get('/product_form', [App\Http\Controllers\productController::class, 'create'])->name('product_form');
Route::post('/product_form', [App\Http\Controllers\productController::class, 'exeCreate'])->name('submit');
Route::get('/detail{id}', [App\Http\Controllers\productController::class, 'detail'])->name('product.detail');

