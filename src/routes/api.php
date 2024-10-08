<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/reset-password/token', [AuthController::class, 'resetPasswordToken'])->middleware('guest')->name('auth.reset-password-token');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset-password');

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/users', [UserController::class, 'getAll'])->name('user.get');
    Route::get('/user/{id}', [UserController::class, 'getUser'])->name('user.get-user');
    Route::put('/user/{id}', [UserController::class, 'updateUser'])->name('user.update-user');
    Route::delete('/user/{id}/force', [UserController::class, 'forceDelete'])->name('user.force-delete-user');
    Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.delete-user');
    Route::get('/users/deleted', [UserController::class, 'deletedUsers'])->name('user.deleted-users');
    Route::post('/user/{id}/restore', [UserController::class, 'restoreUser'])->name('user.restore-user');

    Route::delete('/users/delete', [UserController::class, 'massDelete'])->name('user.delete-users');
    Route::post('/users/restore', [UserController::class, 'massRestore'])->name('user.restore-users');
    Route::delete('/users/force', [UserController::class, 'massForceDelete'])->name('user.force-delete-users');
});
