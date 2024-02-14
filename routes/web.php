<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;
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

Route::get('/', [ProductController::class, 'index'])->middleware('auth');

Route::resource('admin', AdminProductController::class, ['parameters' => [
    'admin' => 'product'
]])->except(['show'])->middleware('admin');

Route::post("/cart/checkout", [CartController::class, 'checkout'])->middleware('auth');
Route::resource('cart', CartController::class)->except(['create', 'show', 'edit'])->middleware('auth');


Route::get('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->name("logout-user")->middleware('auth');
Route::get('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate'])->name("login-user")->middleware('guest');
Route::post('/register', [UserController::class, 'registerRequest'])->name("add-user")->middleware('guest');