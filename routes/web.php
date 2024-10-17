<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\Auth\LoginRegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku',[App\Http\Controllers\BukuController::class,'index']) ;
Route::get('/buku/tambah',[BukuController::class,'create'])->name('buku.create');
Route::delete('/buku/hapus/{id}',[BukuController::class,'destroy'])->name('buku.destroy');
Route::get('/buku/edit/{id}',[BukuController::class,'edit'])->name('buku.edit');
Route::put('/buku/update/{id}',[BukuController::class,'update'])->name('buku.update');
Route::post('/buku/store',[BukuController::class,'store'])->name('buku.store');

Route::controller(LoginRegisterController::class) ->group(function(){
    Route::get('/register','register')->name('register');
    Route::post('/save', 'save') ->name('save');
    Route::get('/login', 'login') ->name('login');
    Route::post('/auth', 'auth') ->name('auth');
    Route::get('/dashboard', 'dashboard') ->name('dashboard');
    Route::get('/logout', 'logout') ->name('logout');

});


