<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // product routes
    Route::get('/products', [ProductsController::class, 'getAll'])->name('products.index');
    Route::get('/add', [productsController::class, 'create'])->name('products.create');
    Route::get('/productsUser', [productsController::class, 'getYour'])->name('products.yourProducts');
    Route::get('/product/{product}/edit', [productsController::class, 'edit'])->name('product.edit');
    Route::get('/product/{product}/delete', [productsController::class, 'delete'])->name('product.delete');
});

require __DIR__ . '/auth.php';
