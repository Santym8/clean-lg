<?php

use App\Http\Controllers\JobsController;
use App\Http\Controllers\audit_trail\AuditTrailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\security\LoginController;
use App\Http\Controllers\security\UserController;
use App\Http\Controllers\security\RoleController;
use App\Http\Controllers\inventario\WarehouseController;
use App\Http\Controllers\inventario\ProductWarehouseController;
use App\Http\Controllers\inventario\CategoryController;
use App\Http\Controllers\inventario\ProductController;
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

// ------------------------------Module Customer-----------------------------
Route::resource('job', JobsController::class)->middleware('auth');
Route::resource('customers', CustomerController::class)->middleware('auth');

// -----------------------------Module Inventory-------------------------------
Route::resource("warehouse", WarehouseController::class)->middleware('auth');
Route::resource("product_warehouse", ProductWarehouseController::class)->middleware('auth');
Route::resource("category", CategoryController::class)->middleware('auth');
Route::resource("product", ProductController::class)->middleware('auth');

// ------------------------------Module Security--------------------------------

// ------------Users----------------
Route::resource('users', UserController::class)->except(
    'show',
    'destroy'
)->middleware('auth');

// ------------Roles----------------
Route::get('roles', [RoleController::class, 'index'])->name('roles.index')->middleware('auth');
Route::put('roles/{id}/change-status', [RoleController::class, 'changeStatus'])->name('roles.changeStatus')->middleware('auth');

// ------------Login----------------
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('auth', [LoginController::class, 'authenticate'])->name('auth');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth'])->name('dashboard');

// ------------------------------Module Auditory--------------------------------
Route::get('audit-trails', [AuditTrailController::class, 'index'])->name('audit_trails.index')->middleware('auth');
