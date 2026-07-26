<?php

namespace App\Services\Page;

use Illuminate\Database\Eloquent\Collection;

interface PageServiceInterface
{
    /**
     * Ambil semua data yang dibutuhkan halaman beranda.
     *
     * @return array{banners: Collection, services: Collection, featuredPortfolios: Collection, testimonials: Collection}
     */
    public function getHomeData(): array;

    /**
     * Ambil semua data yang dibutuhkan halaman layanan.
     *
     * @return array{services: Collection}
     */
    public function getServicesData(): array;
}
