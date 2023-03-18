<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
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

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->name('api.')->group(function () {

    Route::prefix('users')->name('users.')->middleware('can:see-user,user')->group(function () {
        Route::get('/{user}', [UserController::class, 'show'])->middleware('can:see-user,user')->name('show');
        Route::get('/{user}/expenses', [UserController::class, 'expenses'])->name('expenses');
    });

    Route::resource('expenses', ExpenseController::class)->except(['create', 'index', 'edit']);
});


