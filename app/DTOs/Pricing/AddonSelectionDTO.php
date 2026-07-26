<?php

namespace App\DTOs\Pricing;

readonly class AddonSelectionDTO
{
    public function __construct(
        public string $addonId,
        public int    $quantity,
    ) {}
}
