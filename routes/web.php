<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\CagarBudayaController as AdminCagarBudayaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CagarBudayaController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cagar-budaya/list', [CagarBudayaController::class, 'list'])->name('cagar-budaya-list');

Route::prefix('dashboard')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('berita')
            ->middleware(['auth'])
            ->group(function () {
                // USER
                Route::get('berita_index', [AdminBeritaController::class, 'index'])->name('berita_index');
                Route::get('berita_create', [AdminBeritaController::class, 'create'])->name('berita_create');
                Route::get('berita_edit/{id}', [AdminBeritaController::class, 'edit'])->name('berita_edit');
                Route::get('berita_list', [AdminBeritaController::class, 'list'])->name('berita_list');
                Route::post('berita_store', [AdminBeritaController::class, 'store'])->name('berita_store');
                Route::put('berita_update/{token}', [AdminBeritaController::class, 'update'])->name('berita_update');
                // Route::delete('user_delete', [AdminBeritaController::class, 'delete'])->name('user_delete');
            });

        Route::prefix('cagar_budaya')
            ->middleware(['auth'])
            ->group(function () {
                // USER
                Route::get('cagarbudaya_index', [AdminCagarBudayaController::class, 'index'])->name('cagarbudaya_index');
                Route::get('cagarbudaya_create', [AdminCagarBudayaController::class, 'create'])->name('cagarbudaya_create');
                Route::get('cagarbudaya_list', [AdminCagarBudayaController::class, 'list'])->name('cagarbudaya_list');
                Route::post('cagarbudaya_store', [AdminCagarBudayaController::class, 'store'])->name('cagarbudaya_store');
                Route::get('cagarbudaya_edit/{token}', [AdminCagarBudayaController::class, 'edit']);
                Route::delete('cagarbudaya_delete', [AdminCagarBudayaController::class, 'delete'])->name('cagarbudaya_delete');

                Route::get('cagarbudaya_galleries/{cagar_budaya_id}', [AdminCagarBudayaController::class, 'galleries']);
                Route::post('cagarbudaya_gallery_store', [AdminCagarBudayaController::class, 'gallery_store'])->name('cagarbudaya_gallery_store');
                Route::get('cagarbudaya_gallery_edit/{token}', [AdminCagarBudayaController::class, 'gallery_edit']);
                Route::delete('cagarbudaya_gallery_delete', [AdminCagarBudayaController::class, 'gallery_delete'])->name('cagarbudaya_gallery_delete');
                // Route::delete('user_delete', [AdminBeritaController::class, 'delete'])->name('user_delete');
            });

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
