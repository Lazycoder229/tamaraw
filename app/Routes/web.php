<?php
declare(strict_types=1);

use Core\Facades\Route;
use Core\Http\Request;
use Core\Http\Response;
use App\Controllers\HomeController;
use App\Controllers\UsersController;

Route::get('/', [HomeController::class, 'index'])->name('home');

/* Users Routes */
Route::get('/users', [UsersController::class, 'index'])->name('userss.index');
/* Auth Routes */
Route::get('/auth/login', [UsersController::class, 'login'])->name('auth.login');
Route::get('/auth/create', [UsersController::class, 'create'])->name('auth.create');
Route::post('/auth/register', [UsersController::class, 'store'])->name('auth.register');

Route::get('/users/{id}', [UsersController::class, 'show'])->name('userss.show');
Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('userss.edit');
Route::put('/users/{id}', [UsersController::class, 'update'])->name('userss.update');
Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('userss.destroy');

