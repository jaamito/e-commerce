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

Route::get('/', [App\Http\Controllers\welcome::class, 'index'])->name('welcome'); 


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//ProductController

Route::get('/createProduct', [App\Http\Controllers\ProductController::class, 'createProduct'])->name('createProduct')->middleware('auth');
Route::post('/saveProduct', [App\Http\Controllers\ProductController::class, 'saveProduct'])->name('saveProduct')->middleware('auth');
Route::get('/product/info/{id}', [App\Http\Controllers\ProductController::class, 'productInfo'])->name('productInfo');
Route::get('/addToCartProduct/info/{id}', [App\Http\Controllers\ProductController::class, 'addToCartProduct'])->name('addToCartProduct')->middleware('auth');

Route::get('/createCategory', [App\Http\Controllers\CategoryController::class, 'createCategory'])->name('createCategory')->middleware('auth');
Route::post('/saveCategory', [App\Http\Controllers\CategoryController::class, 'saveCategory'])->name('saveCategory')->middleware('auth');
Route::post('/removeCategory', [App\Http\Controllers\CategoryController::class, 'removeCategory'])->name('removeCategory')->middleware('auth');
Route::get('/category/{id}', [App\Http\Controllers\CategoryController::class, 'categoryInfo'])->name('categoryInfo');


Route::get('/toBuy', [App\Http\Controllers\CartController::class, 'cartTobuy'])->name('toBuy')->middleware('auth');
Route::get('/Buy', [App\Http\Controllers\CartController::class, 'buy'])->name('Buy')->middleware('auth');
Route::get('/delBuy/{id}', [App\Http\Controllers\CartController::class, 'deleteCartItem'])->name('delBuy')->middleware('auth');



