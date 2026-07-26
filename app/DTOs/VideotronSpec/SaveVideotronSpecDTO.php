<?php

namespace App\DTOs\VideotronSpec;

class SaveVideotronSpecDTO
{
    public function __construct(
        public readonly ?string $id,
        public readonly string  $brand,
        public readonly ?string $model,
        public readonly int     $power_consumption_watt,
        public readonly int     $brightness,
        public readonly int     $refresh_rate,
        public readonly float   $panel_width_cm,
        public readonly float   $panel_height_cm,
        public readonly int     $pixels_per_meter,
        public readonly float   $price_per_m2,
        public readonly string  $type,
        public readonly ?string $image,
        public readonly ?string $description,
        public readonly bool    $is_active,
    ) {}
}
