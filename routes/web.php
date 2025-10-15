<?php

use App\Http\Controllers\CapitalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceSaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('items', ItemController::class);
Route::resource('purchases', PurchaseController::class);
Route::resource('sales', SaleController::class);
Route::resource('services', ServiceController::class);
Route::resource('service_sales', ServiceSaleController::class);
Route::resource('capitals', CapitalController::class);
Route::resource('debts', DebtController::class);
