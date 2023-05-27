<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DroneController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MapController;
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

Route::middleware(['auth:sanctum'])->group(function () {

    //Route Drone
    Route::get("drones/{drone_id}/{location}", [DroneController::class, "getCurrentLocation"]);
    Route::put("drones_instruction/{drone_id}/{instruction}", [DroneController::class, "updateInstruction"]);

    //Route Plan
    Route::get("plans_name/{name}", [PlanController::class, "getPlanName"]);

    //Route Map
    Route::get("maps/{name}/{fram_id}", [MapController::class, "getImageOfFarm"]);
    Route::put("maps/{name}/{fram_id}", [MapController::class, "updateImageOfFarm"]);
    Route::delete("maps/{name}/{fram_id}", [MapController::class, "deleteImageOfFarm"]);

    //Route logout
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

//Route user
Route::resource("/users", UserController::class);

//Route Drone
Route::resource("/drones", DroneController::class);

//Route Plan
Route::resource('/plans', PlanController::class);
  
//Route Map
Route::resource('/maps', MapController::class);
  
//Route Field
Route::resource("/farms", FarmController::class);

//Route Instruction
Route::resource("/instructions", InstructionController::class);

//Route locations
Route::resource("/locations", LocationController::class);

//Route register
Route::post('/register', [AuthenticationController::class, 'register']);

//Route login
Route::post('/login', [AuthenticationController::class, 'login']);

