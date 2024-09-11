<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/", function () {
    return "Api jalan";
});

Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'actionLogin'])->name('login');
Route::get('me', [\App\Http\Controllers\API\AuthController::class, 'me'])->middleware("auth:api")->name('me');
Route::get('jurusan', [\App\Http\Controllers\API\RestController::class, 'jurusan']);
