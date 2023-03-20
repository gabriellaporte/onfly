<?php

use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->name('api.')->group(function () {

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/expenses', [UserController::class, 'expenses'])->name('expenses');
    });

    Route::apiResource('expenses', ExpenseController::class);
});


