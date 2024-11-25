<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\GreetController;
use App\Http\Controllers\GalleryController;


use App\Http\Middleware\Admin;
use App\Http\Middleware\CustomAuthRedirect;
use App\Http\Middleware\CheckAge;



Route::get('/', function () {
    return view('welcome');
});



Route::controller(LoginRegisterController::class) ->middleware('guest')-> group(function(){
    Route::get('/register','register')->name('register');
    Route::post('/save', 'save') ->name('save');
    Route::get('/login', 'login') ->name('login');
    Route::post('/auth', 'auth') ->name('auth');

});

Route::middleware([CustomAuthRedirect::class])->group(function () {
    Route::get('/dashboard', [LoginRegisterController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
});

Route::middleware([CustomAuthRedirect::class, Admin::class])->group(function () {
    Route::get('/buku',[App\Http\Controllers\BukuController::class,'index'])->name('buku.index'); ; 
    Route::get('/buku/tambah',[BukuController::class,'create'])->name('buku.create');
    Route::delete('/buku/hapus/{id}',[BukuController::class,'destroy'])->name('buku.destroy');
    Route::get('/buku/edit/{id}',[BukuController::class,'edit'])->name('buku.edit');
    Route::put('/buku/update/{id}',[BukuController::class,'update'])->name('buku.update');
    Route::post('/buku/store',[BukuController::class,'store'])->name('buku.store');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

   


});

Route::get('restricted', function () {
    return redirect()->route('dashboard')->withSuccess('Anda berusia lebih dari 18 tahun!');
})->middleware(CheckAge::class);
