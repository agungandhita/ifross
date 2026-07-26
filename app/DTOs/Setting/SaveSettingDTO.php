<?php

namespace App\DTOs\Setting;

class SaveSettingDTO
{
    public function __construct(
        public readonly string $originalKey,
        public readonly string $key,
        public readonly ?string $value,
        public readonly string $type,
        public readonly string $label,
        public readonly string $group,
        public readonly ?string $description,
    ) {}
}
