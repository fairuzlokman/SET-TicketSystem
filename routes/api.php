<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('user', UserController::class)->middleware('auth:sanctum');

Route::post('user-register', [UserController::class, 'store']);
Route::post('user-login', [AuthController::class, 'login']);    
Route::post('user-logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('ticket', TicketController::class)->middleware('auth:sanctum');
