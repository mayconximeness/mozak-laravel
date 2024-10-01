<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Middleware\JwtMiddleware;

// Rotas de Registro e Login que não exigem token
Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login']);

// Rotas que exigem autenticação
Route::middleware([JwtMiddleware::class])->group(function () {
    
    // Rota para obter o usuário autenticado
    Route::get('/user', [JWTAuthController::class, 'getUser']);
    
    // Rota para logout
    Route::post('logout', [JWTAuthController::class, 'logout']);

    // API Resource para EventController (exceto create, edit)
    Route::apiResource('events', EventController::class)->except([
        'create', 'edit'
    ]);

    // Rota para obter eventos do usuário autenticado
    Route::get('/my-events', [EventController::class, 'myEvents']);

    // Rota personalizada para mostrar evento por UUID
    Route::get('/events/uuid/{uuid}', [EventController::class, 'showByUuid']);

});

