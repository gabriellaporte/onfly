<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Authentication Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar rotas de autenticação na API para o app
| Onfly. Essas rotas são carregadas pelo RouteServiceProvider e todas
| elas serão atribuídas ao grupo de middleware "api" e "json.response".
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
