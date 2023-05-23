<?php

use App\Http\Controllers\DroneController;
use App\Http\Controllers\UserController;
use App\Models\Drone;
use App\Http\Controllers\PlanController;
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

//Route user
Route::resource("/users", UserController::class);

//Route Drone
Route::resource("/drones", DroneController::class);

//Route Plan
Route::resource('/plans', PlanController::class);

//Route Map
Route::resource('/maps', MapController::class);