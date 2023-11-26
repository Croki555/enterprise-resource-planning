<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::post('/', [ProductController::class, 'store'])->name('products.add');

Route::get('product/{id}', [ProductController::class, 'show']);
Route::delete('product/{id}', [ProductController::class, 'destroy']);
Route::put('product/{id}', [ProductController::class, 'update']);
