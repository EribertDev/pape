<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\RemoteControlController;

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

Route::middleware(['auth:sanctum'])->prefix('remote-control')->group(function () {
    Route::post('/request', [RemoteControlController::class, 'requestControl']);
    Route::get('/status/{requestId}', [RemoteControlController::class, 'getRequestStatus']);
    Route::post('/accept/{requestId}', [RemoteControlController::class, 'acceptRequest']);
    Route::post('/reject/{requestId}', [RemoteControlController::class, 'rejectRequest']);
    Route::get('/pending-requests', [RemoteControlController::class, 'getPendingRequests']);
    Route::post('/signal', [RemoteControlController::class, 'handleSignal']);
    Route::post('/end-session', [RemoteControlController::class, 'endSession']);
});