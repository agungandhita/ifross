<?php

namespace App\DTOs\Pricing;

readonly class ResolutionDTO
{
    public function __construct(
        public int    $horizontalPixels,
        public int    $verticalPixels,
        public int    $totalPixels,
        public string $formatted,
    ) {}

    /**
     * Hitung resolusi videotron berdasarkan dimensi (meter) & pixel per meter.
     * Default per meter = 256 pixel.
     * Contoh: 4m x 3m -> (4 * 256) x (3 * 256) = 1024 x 768 px
     */
    public static function calculate(
        float $widthM,
        float $heightM,
        int $pixelsPerMeter = 256,
    ): self {
        $ppm = $pixelsPerMeter > 0 ? $pixelsPerMeter : 256;

        $horizontalPixels = (int) round($widthM * $ppm);
        $verticalPixels   = (int) round($heightM * $ppm);
        $totalPixels      = $horizontalPixels * $verticalPixels;

        return new self(
            horizontalPixels: $horizontalPixels,
            verticalPixels:   $verticalPixels,
            totalPixels:      $totalPixels,
            formatted:        "{$horizontalPixels} × {$verticalPixels} px",
        );
    }
}
