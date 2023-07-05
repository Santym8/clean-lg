<?php

use App\Http\Controllers\security\LoginController;
use App\Http\Controllers\security\UserController;
use App\Http\Controllers\security\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\warehouse_controller;
use App\Http\Controllers\product_warehouse_controller;
use App\Http\Controllers\category_controller;
use App\Http\Controllers\product_controller;
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

Route::get('/', function () {
    return view('welcome');
});


// ------------Inventory----------------
Route::resource("warehouse", warehouse_controller::class)->middleware('auth');
Route::resource("product_warehouse", product_warehouse_controller::class)->middleware('auth');
Route::resource("category", category_controller::class)->middleware('auth');
Route::resource("product", product_controller::class)->middleware('auth');

// ------------Users----------------
Route::resource('users', UserController::class)->except(
    'show',
    'destroy'
)->middleware('auth');

Route::resource('roles', RoleController::class)->except(
    'show',
    'destroy'
)->middleware('auth');

// ------------Login----------------
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('auth', [LoginController::class, 'authenticate'])->name('auth');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth'])->name('dashboard');
