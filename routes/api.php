<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::put('/user', [UserController::class, 'update']);
    Route::delete('/user', [UserController::class, 'delete']);
    Route::get('/user/{id}', [UserController::class, 'getUserById']);
});

Route::post('/auth', [AuthController::class, 'login']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/ping', function () {
    return response()->json(['message' => 'Pong, server is online!'], 200);
});

