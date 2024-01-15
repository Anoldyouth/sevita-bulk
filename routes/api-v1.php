<?php

use App\Http\Controllers\PerfumeController;
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

// Работа с записями парфюмерии
Route::post('/perfume', [PerfumeController::class, 'create']);
Route::get('/perfume/{id}', [PerfumeController::class, 'get']);
Route::patch('/perfume/{id}', [PerfumeController::class, 'patch']);
Route::delete('/perfume/{id}', [PerfumeController::class, 'delete']);
Route::post('/perfume:search', [PerfumeController::class, 'search']);
