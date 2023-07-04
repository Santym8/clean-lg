<?php

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

Route::resource("warehouse", warehouse_controller::class);
Route::resource("product_warehouse", product_warehouse_controller::class);
Route::resource("category", category_controller::class);
Route::resource("product", product_controller::class);
