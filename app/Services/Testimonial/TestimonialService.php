<?php

namespace App\Services\Testimonial;

use App\DTOs\Testimonial\SaveTestimonialDTO;
use App\Models\Portfolio\Testimonial;

class TestimonialService implements TestimonialServiceInterface
{
    public function getPaginated(string $search = '', int $perPage = 10)
    {
        return Testimonial::query()
            ->with('portfolio')
            ->when($search, function($q) use ($search) {
                $q->whereLike('name', $search)
                  ->orWhereLike('review', $search);
            })
            ->latest()
            ->paginate($perPage);
    }

    public function getById(string $id): Testimonial
    {
        return Testimonial::findOrFail($id);
    }

    public function save(SaveTestimonialDTO $dto): Testimonial
    {
        return Testimonial::updateOrCreate(
            ['id' => $dto->id],
            [
                'name' => $dto->name,
                'position' => $dto->position,
                'rating' => $dto->rating,
                'review' => $dto->review,
                'portfolio_id' => $dto->portfolio_id,
                'photo' => $dto->photoPath,
                'is_active' => $dto->is_active,
                'sort_order' => $dto->sort_order,
            ]
        );
    }

    public function delete(string $id): bool
    {
        $testimonial = Testimonial::findOrFail($id);
        return $testimonial->delete();
    }
}
