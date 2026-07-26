<?php

namespace App\Services\Page;

use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\Testimonial;
use App\Models\Service\Service;
use App\Models\Site\Banner;
use Illuminate\Database\Eloquent\Collection;

class PageService implements PageServiceInterface
{
    /**
     * Ambil semua data yang dibutuhkan halaman beranda.
     *
     * @return array{banners: Collection, services: Collection, featuredPortfolios: Collection, testimonials: Collection}
     */
    public function getHomeData(): array
    {
        $banners = Banner::active()->ordered()->get();

        $services = Service::active()
            ->with(['packages' => fn ($q) => $q->active()->with('activePromo')->ordered(), 'addonItems' => fn ($q) => $q->active()->ordered()])
            ->ordered()
            ->take(3)
            ->get();

        $featuredPortfolios = Portfolio::active()
            ->featured()
            ->ordered()
            ->take(6)
            ->get();

        $testimonials = Testimonial::active()
            ->ordered()
            ->take(5)
            ->get();

        return compact('banners', 'services', 'featuredPortfolios', 'testimonials');
    }

    /**
     * Ambil semua data yang dibutuhkan halaman layanan.
     *
     * @return array{services: Collection}
     */
    public function getServicesData(): array
    {
        $services = Service::active()
            ->with(['packages' => fn ($q) => $q->active()->with('activePromo')->ordered(), 'addonItems' => fn ($q) => $q->active()->ordered()])
            ->ordered()
            ->get();

        return compact('services');
    }
}
