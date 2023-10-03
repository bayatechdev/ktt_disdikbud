<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\CagarBudayaController as AdminCagarBudayaController;
use App\Http\Controllers\Admin\GalleryAlbumController as AdminGalleryAlbumController;
use App\Http\Controllers\Admin\GalleryVideoController as AdminGalleryVideoController;
use App\Http\Controllers\Admin\GalleryFotoController as AdminGalleryFotoController;
use App\Http\Controllers\Admin\SlideUtamaController as AdminSlideUtamaController;
use App\Http\Controllers\Admin\DesaController as AdminDesaController;
use App\Http\Controllers\Admin\KecamatanController as AdminKecamatanController;
use App\Http\Controllers\Admin\LinkController as AdminLinkController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Admin\HalamanStatisController as AdminHalamanStatisController;
use App\Http\Controllers\Admin\JabatanController as AdminJabatanController;
use App\Http\Controllers\Admin\BidangController as AdminBidangController;
use App\Http\Controllers\Admin\GolonganController as AdminGolonganController;
use App\Http\Controllers\Admin\EselonController as AdminEselonController;
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
                // BERITA
                Route::get('berita_index', [AdminBeritaController::class, 'index'])->name('berita_index');
                Route::get('berita_create', [AdminBeritaController::class, 'create'])->name('berita_create');
                Route::get('berita_edit/{id}', [AdminBeritaController::class, 'edit'])->name('berita_edit');
                Route::get('berita_list', [AdminBeritaController::class, 'list'])->name('berita_list');
                Route::post('berita_store', [AdminBeritaController::class, 'store'])->name('berita_store');
                Route::put('berita_update/{token}', [AdminBeritaController::class, 'update'])->name('berita_update');
                Route::delete('berita_delete', [AdminBeritaController::class, 'delete'])->name('berita_delete');
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

        Route::prefix('kepegawaian')
            ->middleware(['auth'])
            ->group(function () {
                // Jabatan
                Route::resource('jabatan', AdminJabatanController::class);
                Route::get('jabatan_list', [AdminJabatanController::class, 'list']);
                Route::post('jabatan_edit', [AdminJabatanController::class, 'edit'])->name('jabatan_edit');
                Route::delete('jabatan_delete', [AdminJabatanController::class, 'delete'])->name('jabatan_delete');
                // BIDANG
                Route::resource('bidang', AdminBidangController::class);
                Route::get('bidang_list', [AdminBidangController::class, 'list']);
                Route::post('bidang_edit', [AdminBidangController::class, 'edit'])->name('bidang_edit');
                Route::delete('bidang_delete', [AdminBidangController::class, 'delete'])->name('bidang_delete');
                // GOLONGAN
                Route::resource('golongan', AdminGolonganController::class);
                Route::get('golongan_list', [AdminGolonganController::class, 'list']);
                // ESELON
                Route::resource('eselon', AdminEselonController::class);
                Route::get('eselon_list', [AdminEselonController::class, 'list']);
            });

        Route::prefix('data_master')
            ->middleware(['auth'])
            ->group(function () {
                // Desa
                Route::get('desa_index', [AdminDesaController::class, 'index'])->name('desa_index');
                Route::get('desa_list', [AdminDesaController::class, 'list'])->name('desa_list');
                // Kecamatan
                Route::get('kecamatan_index', [AdminKecamatanController::class, 'index'])->name('kecamatan_index');
                Route::get('kecamatan_list', [AdminKecamatanController::class, 'list'])->name('kecamatan_list');
            });

        Route::prefix('galleries')
            ->middleware(['auth'])
            ->group(function () {
                // ALBUM
                Route::get('album_index', [AdminGalleryAlbumController::class, 'index'])->name('album_index');
                Route::get('album_list', [AdminGalleryAlbumController::class, 'list'])->name('album_list');
                Route::post('album_store', [AdminGalleryAlbumController::class, 'store'])->name('album_store');
                Route::get('album_edit/{token}', [AdminGalleryAlbumController::class, 'edit']);
                Route::delete('album_delete', [AdminGalleryAlbumController::class, 'delete'])->name('album_delete');
                // Foto
                Route::get('foto_index', [AdminGalleryFotoController::class, 'index'])->name('foto_index');
                Route::get('foto_list', [AdminGalleryFotoController::class, 'list'])->name('foto_list');
                Route::post('foto_store', [AdminGalleryFotoController::class, 'store'])->name('foto_store');
                Route::get('foto_edit/{token}', [AdminGalleryFotoController::class, 'edit']);
                Route::delete('foto_delete', [AdminGalleryFotoController::class, 'delete'])->name('foto_delete');
                // Video
                Route::get('video_index', [AdminGalleryVideoController::class, 'index'])->name('video_index');
                Route::get('video_list', [AdminGalleryVideoController::class, 'list'])->name('video_list');
                Route::post('video_store', [AdminGalleryVideoController::class, 'store'])->name('video_store');
                Route::get('video_edit/{token}', [AdminGalleryVideoController::class, 'edit']);
                Route::delete('video_delete', [AdminGalleryVideoController::class, 'delete'])->name('video_delete');
            });

        Route::prefix('pages')
            ->middleware(['auth'])
            ->group(function () {
                // HALAMAN STATIS
                Route::get('halaman_statis_index', [AdminHalamanStatisController::class, 'index'])->name('halaman_statis_index');
                Route::get('halaman_statis_create', [AdminHalamanStatisController::class, 'create'])->name('halaman_statis_create');
                Route::get('halaman_statis_edit/{id}', [AdminHalamanStatisController::class, 'edit'])->name('halaman_statis_edit');
                Route::get('halaman_statis_list', [AdminHalamanStatisController::class, 'list'])->name('halaman_statis_list');
                Route::post('halaman_statis_store', [AdminHalamanStatisController::class, 'store'])->name('halaman_statis_store');
                Route::put('halaman_statis_update/{token}', [AdminHalamanStatisController::class, 'update'])->name('halaman_statis_update');
                Route::delete('halaman_statis_delete', [AdminHalamanStatisController::class, 'delete'])->name('halaman_statis_delete');
                // slide
                Route::get('slide_index', [AdminSlideUtamaController::class, 'index'])->name('slide_index');
                Route::get('slide_list', [AdminSlideUtamaController::class, 'list'])->name('slide_list');
                Route::post('slide_store', [AdminSlideUtamaController::class, 'store'])->name('slide_store');
                Route::get('slide_edit/{token}', [AdminSlideUtamaController::class, 'edit']);
                Route::delete('slide_delete', [AdminSlideUtamaController::class, 'delete'])->name('slide_delete');
                // Tag
                Route::get('tag_index', [AdminTagController::class, 'index'])->name('tag_index');
                Route::get('tag_list', [AdminTagController::class, 'list'])->name('tag_list');
                Route::post('tag_store', [AdminTagController::class, 'store'])->name('tag_store');
                Route::get('tag_edit/{token}', [AdminTagController::class, 'edit']);
                Route::delete('tag_delete', [AdminTagController::class, 'delete'])->name('tag_delete');

                // Link
                Route::get('link_index', [AdminLinkController::class, 'index'])->name('link_index');
                Route::get('link_list', [AdminLinkController::class, 'list'])->name('link_list');
                Route::post('link_store', [AdminLinkController::class, 'store'])->name('link_store');
                Route::get('link_edit/{token}', [AdminLinkController::class, 'edit']);
                Route::delete('link_delete', [AdminLinkController::class, 'delete'])->name('link_delete');
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
