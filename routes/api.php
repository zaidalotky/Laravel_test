<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
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


// Api Phase 1

Route::get("list-employees", [ApiController::class, "listEmployee"]);
Route::get("single-employee/{id}", [ApiController::class, "getSingleEmployee"]);
Route::post("add-employee", [ApiController::class, "createEmplyee"]);
Route::delete("delete-employee/{id}", [ApiController::class, "deleteEmployee"]);
Route::put("update-employee/{id}", [ApiController::class, "uptadeEmployee"]);
