<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Gado Gado Kampoeng Biru
|--------------------------------------------------------------------------
| Menggunakan named routes agar mudah dipanggil di seluruh Blade view.
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');

Route::get('/kontak', [ContactController::class, 'index'])->name('contact');

Route::get('/media/{model}/{ref}', [MediaController::class, 'show'])
    ->whereIn('model', ['menu', 'gallery', 'testimonial', 'setting'])
    ->name('media.show');

/*
|--------------------------------------------------------------------------
| Autentikasi Pelanggan
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'login'])->name('login.submit')->middleware('throttle:5,1');
    Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'register'])->name('register.submit')->middleware('throttle:10,1');

    Route::get('/login/google', [CustomerAuthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/login/google/callback', [CustomerAuthController::class, 'handleGoogleCallback'])->name('login.google.callback');
});

Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit')->middleware('throttle:5,1');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    Route::middleware(['auth', 'roles:admin,owner'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('menus', AdminMenuController::class)->except('show');
        Route::resource('galleries', AdminGalleryController::class)->except('show');
        Route::resource('testimonials', AdminTestimonialController::class)->except('show');

        // Hanya owner dapat mengakses pengaturan situs.
        Route::middleware('roles:owner')->group(function () {
            Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
            Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
        });
    });
});