<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard utama admin
    Route::get('/', App\Livewire\Admin\Dashboard::class)->name('dashboard');

    Route::get('/packages', App\Livewire\Admin\PackageIndex::class)->name('packages.index');
    Route::get('/addons', App\Livewire\Admin\AddonIndex::class)->name('addons.index');
    Route::get('/videotron', App\Livewire\Admin\VideotronIndex::class)->name('videotron.index');
    
    Route::get('/portfolios', App\Livewire\Admin\PortfolioIndex::class)->name('portfolios.index');
    Route::get('/testimonials', App\Livewire\Admin\TestimonialIndex::class)->name('testimonials.index');
    Route::get('/banners', App\Livewire\Admin\BannerIndex::class)->name('banners.index');
    
    Route::get('/settings', App\Livewire\Admin\SettingIndex::class)->name('settings.index');
    Route::get('/promos', App\Livewire\Admin\PromoIndex::class)->name('promos.index');
});
