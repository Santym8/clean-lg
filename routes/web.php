<?php

use App\Http\Controllers\job\JobsController;
use App\Http\Controllers\audit_trail\AuditTrailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\security\LoginController;
use App\Http\Controllers\security\UserController;
use App\Http\Controllers\security\RoleController;
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

// ------------------------------Module Customer-----------------------------
Route::resource('job', JobsController::class)->middleware('auth');
Route::resource('customers', CustomerController::class)->middleware('auth');

// -----------------------------Module Inventory-------------------------------
Route::resource("warehouse", warehouse_controller::class)->middleware('auth');
Route::resource("product_warehouse", product_warehouse_controller::class)->middleware('auth');
Route::resource("category", category_controller::class)->middleware('auth');
Route::resource("product", product_controller::class)->middleware('auth');

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
