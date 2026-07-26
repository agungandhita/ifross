<?php

namespace App\DTOs\Banner;

class SaveBannerDTO
{
    public function __construct(
        public readonly ?string $id,
        public readonly string $title,
        public readonly ?string $subtitle,
        public readonly ?string $description,
        public readonly ?string $badge_text,
        public readonly ?string $cta_text,
        public readonly ?string $cta_url,
        public readonly int $sort_order,
        public readonly ?string $imagePath,
        public readonly bool $is_active,
    ) {}
}
