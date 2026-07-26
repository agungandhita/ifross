<?php

namespace App\DTOs\Package;

class SavePackageDTO
{
    public function __construct(
        public readonly ?string $id,
        public readonly string $service_id,
        public readonly string $name,
        public readonly float $price,
        public readonly string $description,
        public readonly ?array $features,
        public readonly ?array $metadata,
        public readonly ?string $imagePath,
        public readonly int $sort_order = 0,
        public readonly bool $is_active,
        public readonly bool $is_featured,
    ) {}
}
