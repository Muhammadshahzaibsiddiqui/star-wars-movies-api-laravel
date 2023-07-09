<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FilmController;

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

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});

Route::middleware(['jwt.auth'])->group(function () {
    Route::controller(FilmController::class)->group(function () {
        Route::get('/films', 'index');
        Route::put('/films/{film}', 'update');
        Route::delete('/films/{film}', 'destroy');
    });
});