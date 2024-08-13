<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('index');
});


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);



Route::get('/logout', [AuthController::class, 'logout']);



Route::get('/auth', [AuthController::class, 'logout']);



Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [UserController::class, 'register']);



Route::get('/test', function () {
    return view('common/header');
});


//admin

Route::get('/admin-usuarios', function () {
    return view('admin/usuarios');
})->middleware('AdminAuthenticate');
