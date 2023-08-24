<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('setting')
            ->middleware(['auth'])
            ->group(function () {
                // USER
                Route::resource('user', UserController::class);
                Route::get('user_list', [UserController::class, 'list']);
                Route::post('user_edit', [UserController::class, 'edit'])->name('user_edit');
                Route::delete('user_delete', [UserController::class, 'delete'])->name('user_delete');
            });

        Route::prefix('account')
            ->middleware(['auth'])
            ->group(function () {
                // USER DETAIL
                Route::get('user_detail', [UserController::class, 'detail'])->name('user_detail');
                Route::post('user_update_password', [UserController::class, 'update_password'])->name('user_update_password');
            });
    });
