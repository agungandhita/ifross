<?php

namespace App\Providers;

use App\Services\Page\PageService;
use App\Services\Page\PageServiceInterface;
use App\Services\Pricing\PricingService;
use App\Services\Pricing\PricingServiceInterface;
use App\Services\Whatsapp\WhatsappMessageBuilderService;
use App\Services\Whatsapp\WhatsappMessageBuilderServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceRegistryProvider extends ServiceProvider
{
    /**
     * Register all service interface bindings.
     */
    public function register(): void
    {
        $this->app->bind(PageServiceInterface::class, PageService::class);

        $this->app->bind(PricingServiceInterface::class, PricingService::class);

        $this->app->bind(
            WhatsappMessageBuilderServiceInterface::class,
            WhatsappMessageBuilderService::class
        );

        $this->app->bind(
            \App\Services\Service\ServiceServiceInterface::class,
            \App\Services\Service\ServiceService::class
        );

        $this->app->bind(
            \App\Services\Dashboard\DashboardServiceInterface::class,
            \App\Services\Dashboard\DashboardService::class
        );

        $this->app->bind(
            \App\Services\Package\PackageServiceInterface::class,
            \App\Services\Package\PackageService::class
        );

        $this->app->bind(
            \App\Services\Addon\AddonServiceInterface::class,
            \App\Services\Addon\AddonService::class
        );

        $this->app->bind(
            \App\Services\Banner\BannerServiceInterface::class,
            \App\Services\Banner\BannerService::class
        );

        $this->app->bind(
            \App\Services\Portfolio\PortfolioServiceInterface::class,
            \App\Services\Portfolio\PortfolioService::class
        );

        $this->app->bind(
            \App\Services\Testimonial\TestimonialServiceInterface::class,
            \App\Services\Testimonial\TestimonialService::class
        );

        $this->app->bind(
            \App\Services\VideotronSpec\VideotronSpecServiceInterface::class,
            \App\Services\VideotronSpec\VideotronSpecService::class
        );

        $this->app->bind(
            \App\Services\Setting\SettingServiceInterface::class,
            \App\Services\Setting\SettingService::class
        );

        $this->app->bind(
            \App\Services\Promo\PromoServiceInterface::class,
            \App\Services\Promo\PromoService::class
        );
    }

    public function boot(): void {}
}
