<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\GreetController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SendEmailController;




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
    Route::get('/galeri/tambah', [GalleryController::class, 'create'])->name('gallery.create');
    Route::delete('/galeri/hapus/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::get('/galeri/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/galeri/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::post('/galeri/store', [GalleryController::class, 'store'])->name('gallery.store');

    

    Route::get('/send-email', [SendEmailController::class, 'index'])->name('send-email.index');
    Route::post('/send-email', [SendEmailController::class, 'sendEmail'])->name('send-email.send');

   


});

Route::get('restricted', function () {
    return redirect()->route('dashboard')->withSuccess('Anda berusia lebih dari 18 tahun!');
})->middleware(CheckAge::class);
