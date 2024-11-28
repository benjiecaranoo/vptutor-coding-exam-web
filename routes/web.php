<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
});

Route::middleware(['auth', 'CheckAdmin'])->group(function () {
    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/products', [App\Http\Controllers\ProductController::class, 'index'])->name('admin.products.index');
    Route::post('/admin/products', [App\Http\Controllers\ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('admin.products.create');
    Route::get('/admin/products/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('admin.products.destroy');
});
