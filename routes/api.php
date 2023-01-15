<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\ApiController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('isapiloggedin')->group(function () {
    Route::get('books/list',[ApiController::class,"books"]); 
});
Route::middleware('isapiadmin')->group(function () {
    Route::get('categories/list',[ApiController::class,"categories"]);
    Route::get('users',[ApiController::class,"users"]);
});



Route::post('users/register',[ApiController::class,'register']);
Route::post('users/login',[ApiController::class,'login']);