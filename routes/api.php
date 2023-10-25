<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\User\UserController;
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


Route::post('v1/auth/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function() {
    Route::get('v1/auth/user', function (Request $request) {
        return 'Bienvenido, ' . auth()->user()->fullname;
    });
    Route::get('v1/users/all', [UserController::class, 'index']);
    Route::post('v1/users/new-user', [UserController::class, 'store']);
    Route::get('v1/auth/logout', [AuthController::class, 'logout']);
});

