<?php

use App\Http\Controllers\customer\JobsController;
use App\Http\Controllers\audit_trail\AuditStatisticsController;
use App\Http\Controllers\audit_trail\AuditTrailController;
use App\Http\Controllers\security\ModuleController;
use App\Http\Controllers\security\ModuleActionController;
use App\Http\Controllers\security\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\customer\DiscountController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\security\LoginController;
use App\Http\Controllers\security\UserController;
use App\Http\Controllers\security\RoleController;
use App\Http\Controllers\inventory\WarehouseController;
use App\Http\Controllers\inventory\ProductWarehouseController;
use App\Http\Controllers\inventory\CategoryController;
use App\Http\Controllers\inventory\ProductController;
use App\Http\Controllers\inventory\ProductMovementController;
use App\Http\Controllers\service_orders\GoodsController;
use App\Http\Controllers\service_orders\ServicesController;
use App\Http\Controllers\service_orders\ServiceOrderGoodsController;
use App\Http\Controllers\service_orders\ServiceOrderController;

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
Route::resource('discounts', DiscountController::class)->middleware('auth');

// -----------------------------Module Inventory-------------------------------
Route::resource("warehouse", WarehouseController::class)->middleware('auth');
Route::put('warehouse/{id}/change-status', [WarehouseController::class, 'changeStatus'])->name('warehouse.changeStatus')->middleware('auth');
Route::resource("product_warehouse", ProductWarehouseController::class)->middleware('auth');
Route::put('product_warehouse/{id}/change-status', [ProductWarehouseController::class, 'changeStatus'])->name('product_warehouse.changeStatus')->middleware('auth');
Route::resource("category", CategoryController::class)->middleware('auth');
Route::put('category/{id}/change-status', [CategoryController::class, 'changeStatus'])->name('category.changeStatus')->middleware('auth');
Route::resource("product", ProductController::class)->middleware('auth');
Route::put('product/{id}/change-status', [ProductController::class, 'changeStatus'])->name('product.changeStatus')->middleware('auth');
Route::get('/product-movement', [ProductMovementController::class, 'index'])->name('product_movement.index')->middleware('auth');
Route::get('/product-movement/create', [ProductMovementController::class, 'create'])->name('product_movement.create')->middleware('auth');
Route::post('/product-movement', [ProductMovementController::class, 'store'])->name('product_movement.store')->middleware('auth');
Route::get('/product-movement/{id}/edit', [ProductMovementController::class, 'edit'])->name('product_movement.edit')->middleware('auth');
Route::put('/product-movement/{id}', [ProductMovementController::class, 'update'])->name('product_movement.update')->middleware('auth');
Route::delete('/product-movement/{id}', [ProductMovementController::class, 'destroy'])->name('product_movement.destroy')->middleware('auth');

// ------------------------------Module Security--------------------------------
// ------------Modules----------------
Route::get('modules', [ModuleController::class, 'index'])->name('modules.index')->middleware('auth');
Route::put('modules/{id}/change-status', [ModuleController::class, 'changeStatus'])->name('modules.changeStatus')->middleware('auth');
Route::get('modules/{id}/edit', [ModuleController::class, 'edit'])->name('modules.edit')->middleware('auth');
Route::patch('modules/{id}/update', [ModuleController::class, 'update'])->name('modules.update')->middleware('auth');
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
Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('auth');
Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store')->middleware('auth');
Route::delete('roles/{id}/destroy', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('auth');
// ------------Users----------------
Route::resource('users', UserController::class)->except(
    'show',
    'destroy'
)->middleware('auth');
Route::patch('users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword')->middleware('auth');

// ------------User Profile----------------
Route::get('user-profile', [UserProfileController::class, 'index'])->name('user_profile.index')->middleware('auth');
Route::patch('user-profile/update-profile', [UserProfileController::class, 'updateProfile'])->name('user_profile.updateProfile')->middleware('auth');
Route::get('user-profile/edit-password', [UserProfileController::class, 'editPassword'])->name('user_profile.editPassword')->middleware('auth');
Route::patch('user-profile/update-password', [UserProfileController::class, 'updatePassword'])->name('user_profile.updatePassword')->middleware('auth');
// ------------Login----------------
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('auth', [LoginController::class, 'authenticate'])->name('auth');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// ------------------------------Module Auditory--------------------------------
Route::get('audit-trails', [AuditTrailController::class, 'index'])->name('audit_trails.index')->middleware('auth');
Route::get('audit-trails/user-actions', [AuditStatisticsController::class, 'userActions'])->name('audit_trails.userActions')->middleware('auth');

// ------------------------------Module Service Orders-----------------------------
Route::resource('services', ServicesController::class)->middleware('auth');
Route::resource('goods', GoodsController::class)->middleware('auth');
Route::resource('service_orders_goods', ServiceOrderGoodsController::class)->middleware('auth');
//Route::get('service_orders_goods/{service_order_goods}/goods', 'OrderServiceController@showGoods')->name('order_services.show_goods');
Route::resource('service_orders', ServiceOrderController::class)->middleware('auth');
