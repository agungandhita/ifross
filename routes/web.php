<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/layanan', [PageController::class, 'services'])->name('layanan.index');
Route::get('/portofolio', [PageController::class, 'portfolios'])->name('portofolio.index');
Route::get('/portofolio/{portfolio:slug}', [PageController::class, 'portfolioDetail'])->name('portofolio.show');

Route::middleware(['auth', 'verified'])->group(function () {
    // Redirect /dashboard ke halaman admin utama agar konsisten
    Route::redirect('/dashboard', '/admin')->name('dashboard');
});

require __DIR__.'/settings.php';
require base_path('routes/admin.php');
