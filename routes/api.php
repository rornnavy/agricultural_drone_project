<?php

<<<<<<< HEAD
use App\Http\Controllers\DroneController;
use App\Http\Controllers\UserController;
use App\Models\Drone;
=======
use App\Http\Controllers\PlanController;
>>>>>>> da5381b4761b4d1151944d505da3648d4e172b8c
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
<<<<<<< HEAD

//Route user
Route::resource("/users", UserController::class);

//Route Drone
Route::resource("/drones", DroneController::class);
=======
Route::get('/plans',[PlanController::class,'index']);
Route::post('/plans',[PlanController::class,'store']);
Route::get('/plans/{id}',[PlanController::class,'show']);
Route::put('/plans/{id}',[PlanController::class,'update']);
Route::delete('/plans/{id}',[PlanController::class,'destroy']);
>>>>>>> da5381b4761b4d1151944d505da3648d4e172b8c
