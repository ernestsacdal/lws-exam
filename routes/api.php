<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AnimesController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




//user auth routes
Route::post('/login', [UsersController::class, 'login']);
Route::post('/users', [UsersController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    //user logout route
    Route::get('/logout', [UsersController::class, 'logout']);






    //anime routes
    Route::post('/anime', [AnimesController::class, 'store']);
    Route::get('/anime', [AnimesController::class, 'list']);
    Route::get('/anime/{id}', [AnimesController::class, 'show']);
    Route::put('/anime/{id}', [AnimesController::class, 'update']);
    Route::delete('/anime/{id}', [AnimesController::class, 'delete']);
});
