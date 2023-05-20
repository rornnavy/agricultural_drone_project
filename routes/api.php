<?php

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
Route::get('/plans',[PlanController::class,'index']);
Route::post('/plans',[PlanController::class,'store']);
Route::get('/plans/{id}',[PlanController::class,'show']);
Route::put('/plans/{id}',[PlanController::class,'update']);
Route::delete('/plans/{id}',[PlanController::class,'destroy']);
