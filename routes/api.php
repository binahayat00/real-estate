<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Auth\AuthController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('api-login');
    Route::post('register', 'register')->name('api-register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::controller(AppointmentController::class)->group(function () {
    Route::get('appointment', 'index');
    Route::get('appointment/{appointment}', 'show');
    Route::post('appointment', 'store');
    Route::put('appointment/{appointment}', 'update');
    Route::delete('appointment/{appointment}', 'destroy');
    Route::put('addZipcodeToAppointments/', 'addZipcodeToAppointments');
    Route::post('assignAgentToAppointment/', 'assignAgentToAppointment');
});
