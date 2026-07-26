<?php

namespace App\DTOs\Testimonial;

class SaveTestimonialDTO
{
    public function __construct(
        public readonly ?string $id,
        public readonly ?string $portfolio_id,
        public readonly string $name,
        public readonly ?string $position,
        public readonly int $rating,
        public readonly string $review,
        public readonly ?string $photoPath,
        public readonly bool $is_active,
        public readonly int $sort_order,
    ) {}
}
