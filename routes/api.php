<?php

use App\Http\Controllers\Api\GaleriController as ApiGaleriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\GreetController;
use App\Http\Controllers\GaleriController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/info',[InfoController::class,'index'])->name('info.index');

Route::get('/greet', [GreetController::class, 'greet'])->name('greet');

Route::get('/gallery', [ApiGaleriController::class, 'indexAPI']) ->name('galeri.index');

