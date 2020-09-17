<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\AuthController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware(['jwt', 'master'])->group(function () {
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::patch('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);

    Route::get('sector', [SectorController::class, 'index']);
    Route::post('sector', [SectorController::class, 'store']);
    Route::get('sector/{id}', [SectorController::class, 'show']);
    Route::patch('sector/{id}', [SectorController::class, 'update']);
    Route::delete('sector/{id}', [SectorController::class, 'destroy']);
});

Route::middleware(['jwt'])->group(function () {
    Route::get('meeting', [MeetingController::class, 'index']);
    Route::post('meeting', [MeetingController::class, 'store']);
    Route::get('meeting/{id}', [MeetingController::class, 'show']);
    Route::patch('meeting/{id}', [MeetingController::class, 'update']);
    Route::delete('meeting/{id}', [MeetingController::class, 'destroy']);
});