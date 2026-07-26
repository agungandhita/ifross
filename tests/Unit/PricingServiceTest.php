<?php

use App\DTOs\Pricing\AddonSelectionDTO;
use App\Models\Service\AddonItem;
use App\Models\Service\Package;
use App\Models\Service\Service;
use App\Models\Service\VideotronSpec;
use App\Services\Pricing\PricingService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('calculates package price correctly without addons', function () {
    $service = Service::factory()->create();
    $package = Package::factory()->create(['service_id' => $service->id, 'price' => 5000000]);

    $pricingService = new PricingService();
    $total = $pricingService->calculatePackagePrice($package, []);

    expect($total)->toEqual(5000000);
});

it('calculates package price correctly with addons', function () {
    $service = Service::factory()->create();
    $package = Package::factory()->create(['service_id' => $service->id, 'price' => 5000000]);
    $addon1 = AddonItem::factory()->create(['service_id' => $service->id, 'price' => 500000]);
    $addon2 = AddonItem::factory()->create(['service_id' => $service->id, 'price' => 250000]);

    $addons = [
        new AddonSelectionDTO(addonId: $addon1->id, quantity: 2), // 2 * 500,000 = 1,000,000
        new AddonSelectionDTO(addonId: $addon2->id, quantity: 1), // 1 * 250,000 = 250,000
    ];

    $pricingService = new PricingService();
    $total = $pricingService->calculatePackagePrice($package, $addons);

    // 5,000,000 + 1,000,000 + 250,000 = 6,250,000
    expect($total)->toEqual(6250000);
});

it('calculates videotron price based on area and addons', function () {
    $spec = VideotronSpec::factory()->create(['price_per_m2' => 1500000]);
    
    // Width: 4, Height: 3 => Area: 12m2.
    // Base price: 12 * 1,500,000 = 18,000,000
    
    $service = Service::factory()->create();
    $addon = AddonItem::factory()->create(['service_id' => $service->id, 'price' => 1000000]);
    
    $addons = [
        new AddonSelectionDTO(addonId: $addon->id, quantity: 2), // 2,000,000
    ];
    
    $pricingService = new PricingService();
    $total = $pricingService->calculateCustomVideotronPrice(4, 3, $spec, $addons);
    
    // 18,000,000 + 2,000,000 = 20,000,000
    expect($total)->toEqual(20000000);
});

it('calculates videotron resolution correctly', function () {
    $spec = VideotronSpec::factory()->create(['power_consumption_watt' => 350]);
    
    // width = 3m, height = 2m
    $pricingService = new PricingService();
    $resolution = $pricingService->calculateResolution(3, 2, $spec);
    
    // Default 256 px per meter:
    // horizontal = round(3 * 256) = 768
    // vertical = round(2 * 256) = 512
    expect($resolution->horizontalPixels)->toEqual(768)
        ->and($resolution->verticalPixels)->toEqual(512)
        ->and($resolution->formatted)->toEqual('768 × 512 px');
});
