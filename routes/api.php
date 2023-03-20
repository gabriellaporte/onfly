<?php

use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar rotas de API para o app da Onfly. Essas
| rotas são carregadas pelo RouteServiceProvider e todas elas serão
| atribuídas ao grupo de middleware "api" e "json.response".
|
*/

Route::middleware('auth:sanctum')->name('api.')->group(function () {

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/expenses', [UserController::class, 'expenses'])->name('expenses');
    });

    Route::apiResource('expenses', ExpenseController::class);
});


