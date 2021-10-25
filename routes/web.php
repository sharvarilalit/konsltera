<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 Route::get('home', [HomeController::class, 'index'])->name('home');

//User View
Route::group(['prefix' => 'user',], function () {
Route::get('product', [ProductController::class, 'display'])->name('user.products');
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
});

//Product Module
Route::group(['prefix' => 'admin',  'middleware' => 'is_admin'], function () {
  Route::get('home', [HomeController::class, 'adminHome'])->name('admin.home');
  Route::get('product/{slug?}',  [ProductController::class, 'index'])->name('admin.products');
  Route::get('add/product',  [ProductController::class, 'add'])->name('admin.product.add');
  Route::post('product/save',  [ProductController::class, 'save'])->name('admin.product.save');
  Route::get('product/edit/{id?}',  [ProductController::class, 'add'])->name('admin.product.edit');
  Route::get('product/delete/{id}',  [ProductController::class, 'delete'])->name('admin.product.deleted');
});