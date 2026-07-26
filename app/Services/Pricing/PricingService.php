<?php

namespace App\Services\Pricing;

use App\DTOs\Pricing\AddonSelectionDTO;
use App\DTOs\Pricing\ResolutionDTO;
use App\Models\Service\AddonItem;
use App\Models\Service\Package;
use App\Models\Service\VideotronSpec;
use InvalidArgumentException;

class PricingService implements PricingServiceInterface
{
    /**
     * Kalkulasi total harga paket + addon yang dipilih.
     *
     * @param  Package                  $package
     * @param  array<AddonSelectionDTO> $addons
     * @return float
     */
    public function calculatePackagePrice(Package $package, array $addons): float
    {
        $total = $package->price;

        foreach ($addons as $addon) {
            if (! $addon instanceof AddonSelectionDTO) {
                throw new InvalidArgumentException('Each addon must be an instance of AddonSelectionDTO.');
            }

            if ($addon->quantity <= 0) {
                continue;
            }

            /** @var AddonItem|null $addonItem */
            $addonItem = AddonItem::find($addon->addonId);

            if (! $addonItem) {
                continue;
            }

            $total += $addonItem->price * $addon->quantity;
        }

        return $total;
    }

    /**
     * Kalkulasi harga custom LED Videotron berdasarkan dimensi layar + addon.
     *
     * @param  float                   $widthM
     * @param  float                   $heightM
     * @param  VideotronSpec           $spec
     * @param  array<AddonSelectionDTO> $addons
     * @return float
     */
    public function calculateCustomVideotronPrice(
        float $widthM,
        float $heightM,
        VideotronSpec $spec,
        array $addons,
    ): float {
        if ($widthM <= 0 || $heightM <= 0) {
            throw new InvalidArgumentException('Lebar dan tinggi layar harus lebih dari 0.');
        }

        $area  = $widthM * $heightM;
        $total = $area * $spec->price_per_m2;

        foreach ($addons as $addon) {
            if (! $addon instanceof AddonSelectionDTO) {
                throw new InvalidArgumentException('Each addon must be an instance of AddonSelectionDTO.');
            }

            if ($addon->quantity <= 0) {
                continue;
            }

            /** @var AddonItem|null $addonItem */
            $addonItem = AddonItem::find($addon->addonId);

            if (! $addonItem) {
                continue;
            }

            $total += $addonItem->price * $addon->quantity;
        }

        return $total;
    }

    /**
     * Hitung estimasi resolusi layar LED Videotron.
     *
     * @param  float         $widthM
     * @param  float         $heightM
     * @param  VideotronSpec $spec
     * @return ResolutionDTO
     */
    public function calculateResolution(float $widthM, float $heightM, VideotronSpec $spec): ResolutionDTO
    {
        if ($widthM <= 0 || $heightM <= 0) {
            throw new InvalidArgumentException('Lebar dan tinggi layar harus lebih dari 0.');
        }

        $ppm = $spec->pixels_per_meter ?? 256;
        return ResolutionDTO::calculate($widthM, $heightM, $ppm);
    }
}
