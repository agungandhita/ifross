<?php

namespace App\DTOs\Portfolio;

class SavePortfolioDTO
{
    public function __construct(
        public readonly ?string $id,
        public readonly string $title,
        public readonly string $category,
        public readonly ?string $description,
        public readonly ?string $location,
        public readonly ?string $event_date,
        public readonly ?string $client_name,
        public readonly ?array $images,
        public readonly ?string $thumbnail,
        public readonly ?string $video_url,
        public readonly bool $is_active,
        public readonly bool $is_featured,
        public readonly int $sort_order,
    ) {}
}
