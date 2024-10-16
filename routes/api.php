<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rota para obter o usuário autenticado, protegida por middleware 'auth:sanctum'
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rota para gerenciar as operações CRUD de produtos com ProductController
Route::apiResource('products', ProductController::class);

// Rota para registro de usuários
Route::post('/register', [AuthController::class, 'register']);

// Rota para login de usuários
Route::post('/login', [AuthController::class, 'login']);

// Rota para logout de usuários, protegida por middleware 'auth:sanctum'
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');




