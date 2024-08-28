<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controladores

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;

// Custom Middleware
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsWritter;
use App\Http\Middleware\CanWrite;

Route::get('/', function () {
    return view('index');
});


Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login']);



Route::get('/logout', [AuthController::class, 'logout']);



Route::get('/auth', [AuthController::class, 'logout']);



Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [UserController::class, 'register']);


// test
Route::get('/test', function () {
    return view('test');
});


//auth



// admin

Route::get('/admin/usuarios', function () {
    return view('admin.usuarios.usuarios');
})->middleware(IsAdmin::class);

Route::get('/admin/noticias', function () {
    return view('admin.noticias.noticias');
})->middleware(IsAdmin::class);

Route::get('/admin/redactar', function () {
    return view('admin.redactar.redactar');
})->middleware(IsAdmin::class);

// admin - usuarios
Route::get('/admin/usuarios/create', function () {
    return view('admin.usuarios.create');
})->middleware(IsAdmin::class);

Route::get('/admin/usuarios/edit', function () {
    return view('admin.usuarios.edit');
})->middleware(IsAdmin::class);


Route::post('/create', [UserController::class, 'create'])->middleware([IsAdmin::class]);

Route::post('/edit', [UserController::class, 'edit'])->middleware([IsAdmin::class]);

Route::get('/delete', [UserController::class, 'delete'])->middleware([IsAdmin::class]);


//admin - noticias

Route::post('/redactar', [NewsController::class, 'create'])->middleware([IsAdmin::class]);


// noticias - dinamico
