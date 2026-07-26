<?php

namespace App\DTOs\Dashboard;

readonly class DashboardStatsDTO
{
    public function __construct(
        public int $totalServices,
        public int $totalPackages,
        public int $totalAddons,
        public int $totalPortfolios,
        public int $totalTestimonials,
        public int $totalBanners,
    ) {}
}
