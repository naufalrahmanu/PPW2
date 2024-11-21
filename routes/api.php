<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\GreetController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/info',[InfoController::class,'index'])->name('info.index');

Route::get('/greet', [GreetController::class, 'greet'])->name('greet');
