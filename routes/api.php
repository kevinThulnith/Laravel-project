<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\authController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products', ProductsController::class);
// auth:user routes
Route::post('/register', [authController::class, 'register']);
Route::post('/login', [authController::class, 'login']);
Route::post('/logout', [authController::class, 'logout'])->middleware('auth:sanctum');
