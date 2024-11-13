<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
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

Route::middleware('auth:sanctum')->group(function (){
    Route::get('logout',[AuthController::class,'logout']);
    Route::prefix('student')->group(function (){
        Route::get('/',[StudentController::class,'index']);
        Route::post('/',[StudentController::class,'store']);
        Route::post('/{id}',[StudentController::class,'update']);

    });

});
Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
