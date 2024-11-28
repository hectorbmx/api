<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EntrenoController;



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');


// Route::prefix('users')->group(function () {
//     // Route::get('/', [UserController::class, 'index']); // Listar todos los usuarios
//     Route::get('/{id}', [UserController::class, 'show']); // Ver un usuario por ID
//     // Route::post('/', [UserController::class, 'store']); // Crear un usuario
//     Route::put('/{id}', [UserController::class, 'update']); // Actualizar un usuario
//     Route::delete('/{id}', [UserController::class, 'destroy']); // Eliminar un usuario
// });
Route::post('/users', [UserController::class, 'store']); // Ruta sin middleware
Route::get('/', [UserController::class, 'index']); // Listar todos los usuarios

Route::get('/entrenos', [EntrenoController::class, 'index']);
Route::get('/entrenos/{id}', [EntrenoController::class, 'show']);
Route::post('/entrenos', [EntrenoController::class, 'store']);
Route::put('/entrenos/{id}', [EntrenoController::class, 'update']);
Route::delete('/entrenos/{id}', [EntrenoController::class, 'destroy']);
Route::get('/entrenos/fecha/{fecha}', [EntrenoController::class, 'getByDate']);
Route::post('/users/{id}/update-photo', [UserController::class, 'updatePhoto']);
