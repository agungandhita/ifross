<?php

namespace App\DTOs\Addon;

class SaveAddonDTO
{
    public function __construct(
        public readonly ?string $id,
        public readonly string $service_id,
        public readonly string $name,
        public readonly float $price,
        public readonly string $unit,
        public readonly ?string $description,
        public readonly bool $is_active,
        public readonly int $sort_order,
    ) {}
}
