<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RoomController;
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

    Route::post('user', [UserController::class, 'store']);
    Route::patch('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);

    Route::post('sector', [SectorController::class, 'store']);
    Route::patch('sector/{id}', [SectorController::class, 'update']);
    Route::delete('sector/{id}', [SectorController::class, 'destroy']);
});

Route::middleware(['jwt'])->group(function () {
    Route::get('sector', [SectorController::class, 'index']);
    Route::get('sector/{id}', [SectorController::class, 'show']);

    Route::get('type', [TypeController::class, 'index']);

    Route::get('meeting', [MeetingController::class, 'index']);

    Route::post('meeting', [MeetingController::class, 'store']);
    Route::get('meeting/{id}', [MeetingController::class, 'show']);
    Route::patch('meeting/{id}', [MeetingController::class, 'update']);
    Route::delete('meeting/{id}', [MeetingController::class, 'destroy']);

    Route::post('consult-meeting', [MeetingController::class, 'consultMeeting']);
    Route::post('consult-meeting-room', [MeetingController::class, 'consultMeetingRoom']);

    Route::get('user-auth', [AuthController::class, 'show']);
    Route::get('user', [UserController::class, 'index']);
    Route::get('user/{id}', [UserController::class, 'show']);

    Route::get('location', [LocationController::class, 'index']);
    Route::get('room/{id}', [RoomController::class, 'index']);
});