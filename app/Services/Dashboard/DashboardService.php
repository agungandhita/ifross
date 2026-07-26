<?php

namespace App\Services\Dashboard;

use App\DTOs\Dashboard\DashboardStatsDTO;
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\Testimonial;
use App\Models\Service\AddonItem;
use App\Models\Service\Package;
use App\Models\Service\Service;
use App\Models\Site\Banner;
use Illuminate\Database\Eloquent\Collection;

class DashboardService implements DashboardServiceInterface
{
    public function getStats(): DashboardStatsDTO
    {
        return new DashboardStatsDTO(
            totalServices: Service::count(),
            totalPackages: Package::count(),
            totalAddons: AddonItem::count(),
            totalPortfolios: Portfolio::count(),
            totalTestimonials: Testimonial::count(),
            totalBanners: Banner::count(),
        );
    }

    public function getRecentPortfolios(int $limit = 5): Collection
    {
        return Portfolio::query()
            ->latest('created_at')
            ->take($limit)
            ->get();
    }
}
