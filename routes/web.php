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

// ログイン画面
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// 商品一覧画面表示 検索機能
Route::get('/product', [App\Http\Controllers\ProductController::class, 'showList','search'])->name('product');
// 削除機能
Route::delete('/delete{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('product.destroy');
// 登録画面表示
Route::get('/product_form', [App\Http\Controllers\productController::class, 'create'])->name('product_form');
// 登録処理
Route::post('/product_form', [App\Http\Controllers\productController::class, 'exeCreate'])->name('submit');
// 詳細画面
Route::get('/detail{id}', [App\Http\Controllers\productController::class, 'detail'])->name('product.detail');
// 編集画面
Route::get('/edit/{id}', [App\Http\Controllers\productController::class, 'edit'])->name('product.edit');
// 更新処理
Route::post('/update/{id}', [App\Http\Controllers\productController::class, 'update'])->name('product.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
