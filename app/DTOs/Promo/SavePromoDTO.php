<?php

namespace App\DTOs\Promo;

class SavePromoDTO
{
    public function __construct(
        public readonly ?string $id,
        public readonly string  $package_id,
        public readonly string  $name,
        public readonly ?string $description,
        public readonly string  $discount_type,
        public readonly float   $discount_value,
        public readonly ?string $starts_at,
        public readonly ?string $ends_at,
        public readonly bool    $is_active,
    ) {}
}
