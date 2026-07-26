<?php

namespace App\Services\Pricing;

use App\DTOs\Pricing\AddonSelectionDTO;
use App\DTOs\Pricing\ResolutionDTO;
use App\Models\Service\AddonItem;
use App\Models\Service\Package;
use App\Models\Service\VideotronSpec;
use InvalidArgumentException;

interface PricingServiceInterface
{
    /**
     * Kalkulasi total harga paket + addon yang dipilih.
     *
     * @param  Package                $package
     * @param  array<AddonSelectionDTO> $addons
     * @return float
     */
    public function calculatePackagePrice(Package $package, array $addons): float;

    /**
     * Kalkulasi harga custom LED Videotron berdasarkan dimensi layar + addon.
     *
     * @param  float                   $widthM   Lebar layar dalam meter
     * @param  float                   $heightM  Tinggi layar dalam meter
     * @param  VideotronSpec           $spec     Spesifikasi panel yang dipilih
     * @param  array<AddonSelectionDTO> $addons
     * @return float
     */
    public function calculateCustomVideotronPrice(
        float $widthM,
        float $heightM,
        VideotronSpec $spec,
        array $addons,
    ): float;

    /**
     * Hitung estimasi resolusi layar LED Videotron.
     *
     * @param  float         $widthM
     * @param  float         $heightM
     * @param  VideotronSpec $spec
     * @return ResolutionDTO
     */
    public function calculateResolution(float $widthM, float $heightM, VideotronSpec $spec): ResolutionDTO;
}
