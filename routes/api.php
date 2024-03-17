<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;

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

Route::middleware('guest:sanctum')->group(function(){
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('movie/all',     [MovieController::class, 'index'])->name('movie.index');
    Route::get('movie/{id}',    [MovieController::class, 'show'])->name('movie.show');
    Route::put('movie/{id}',    [MovieController::class, 'update'])->name('movie.update');
    Route::delete('movie/{id}', [MovieController::class, 'delete'])->name('movie.delete');
    Route::any('logout',        [AuthController::class, 'logout'])->name('logout');
});
