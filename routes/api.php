<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\RemoteAccessController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// API pour les sessions de contrôle à distance
Route::prefix('remote-access')->group(function () {
    Route::post('/session', [RemoteAccessController::class, 'createSession']);
    Route::get('/session/{sessionId}/status', [RemoteAccessController::class, 'getSessionStatus']);
    Route::post('/session/{sessionId}/response', [RemoteAccessController::class, 'handleResponse']);
    Route::post('/session/{sessionId}/end', [RemoteAccessController::class, 'endSession']);
});