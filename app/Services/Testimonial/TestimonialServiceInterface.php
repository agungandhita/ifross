<?php

namespace App\Services\Testimonial;

use App\DTOs\Testimonial\SaveTestimonialDTO;
use App\Models\Portfolio\Testimonial;

interface TestimonialServiceInterface
{
    /**
     * Get a paginated list of testimonials.
     */
    public function getPaginated(string $search = '', int $perPage = 10);

    /**
     * Get a testimonial by ID.
     */
    public function getById(string $id): Testimonial;

    /**
     * Save a testimonial (create or update).
     */
    public function save(SaveTestimonialDTO $dto): Testimonial;

    /**
     * Delete a testimonial by ID.
     */
    public function delete(string $id): bool;
}
