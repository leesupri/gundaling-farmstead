<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// --- PUBLIC ENGLISH (default) ---
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/reservations', [ReservationController::class, 'create'])->name('reservations');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/confirmation/{reservation}', [ReservationController::class, 'confirmation'])->name('reservations.confirmation');
Route::get('/promo', [PromoController::class, 'index'])->name('promo');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactStore'])->name('contact.store');

// --- INDONESIAN ROUTES ---
Route::prefix('id')->name('id.')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/reservasi', [ReservationController::class, 'create'])->name('reservations');
    Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservasi/konfirmasi/{reservation}', [ReservationController::class, 'confirmation'])->name('reservations.confirmation');
    Route::get('/promo', [PromoController::class, 'index'])->name('promo');
    Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
    Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
    Route::post('/kontak', [PageController::class, 'contactStore'])->name('contact.store');
});

// --- SECURE BEO DOWNLOAD (admin only) ---
Route::middleware(['auth'])
    ->get('/secure/beo/{reservation}', [ReservationController::class, 'downloadBeo'])
    ->name('beo.download');
