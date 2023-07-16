<?php

use App\Http\Controllers\customer\JobsController;
use App\Http\Controllers\audit_trail\AuditStatisticsController;
use App\Http\Controllers\audit_trail\AuditTrailController;
use App\Http\Controllers\security\ModuleController;
use App\Http\Controllers\security\ModuleActionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\security\LoginController;
use App\Http\Controllers\security\UserController;
use App\Http\Controllers\security\RoleController;
use App\Http\Controllers\inventory\WarehouseController;
use App\Http\Controllers\inventory\ProductWarehouseController;
use App\Http\Controllers\inventory\CategoryController;
use App\Http\Controllers\inventory\ProductController;
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
    return redirect(route("login"));
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
// ------------Modules----------------
Route::get('modules', [ModuleController::class, 'index'])->name('modules.index')->middleware('auth');
Route::put('modules/{id}/change-status', [ModuleController::class, 'changeStatus'])->name('modules.changeStatus')->middleware('auth');

// ------------Module Actions----------------
Route::get('module-actions', [ModuleActionController::class, 'index'])->name('module_actions.index')->middleware('auth');
Route::put('module-actions/{id}/change-status', [ModuleActionController::class, 'changeStatus'])->name('module_actions.changeStatus')->middleware('auth');
Route::get('module-actions/{id}/edit', [ModuleActionController::class, 'edit'])->name('module_actions.edit')->middleware('auth');
Route::patch('module-actions/{id}/update', [ModuleActionController::class, 'update'])->name('module_actions.update')->middleware('auth');

// ------------Roles----------------
Route::get('roles', [RoleController::class, 'index'])->name('roles.index')->middleware('auth');
Route::put('roles/{id}/change-status', [RoleController::class, 'changeStatus'])->name('roles.changeStatus')->middleware('auth');
Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('auth');
Route::patch('roles/{id}/update', [RoleController::class, 'update'])->name('roles.update')->middleware('auth');
// ------------Users----------------
Route::resource('users', UserController::class)->except(
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

// ------------------------------Module Auditory--------------------------------
Route::get('audit-trails', [AuditTrailController::class, 'index'])->name('audit_trails.index')->middleware('auth');
Route::get('audit-trails/user-actions', [AuditStatisticsController::class, 'userActions'])->name('audit_trails.userActions')->middleware('auth');
