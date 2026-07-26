<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class TestimonialForm extends Form
{
    use WithFileUploads;

    public ?string $testimonialId = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string|max:255')]
    public string $position = '';

    #[Validate('required|integer|min:1|max:5')]
    public int $rating = 5;

    #[Validate('required|string')]
    public string $review = '';

    #[Validate('nullable|exists:portfolios,id')]
    public ?string $portfolio_id = null;

    #[Validate('boolean')]
    public bool $is_active = true;

    #[Validate('required|integer|min:0')]
    public int $sort_order = 0;

    #[Validate('nullable|image|max:1024')] // max 1MB
    public $photo;

    public ?string $existingPhoto = null;

    public function setTestimonial($testimonial)
    {
        $this->testimonialId = $testimonial->id;
        $this->name = $testimonial->name;
        $this->position = $testimonial->position ?? '';
        $this->rating = $testimonial->rating;
        $this->review = $testimonial->review;
        $this->portfolio_id = $testimonial->portfolio_id;
        $this->existingPhoto = $testimonial->photo;
        $this->is_active = $testimonial->is_active;
        $this->sort_order = $testimonial->sort_order;
    }

    public function clear()
    {
        $this->reset([
            'testimonialId', 'name', 'position', 
            'rating', 'review', 'portfolio_id', 'photo', 'existingPhoto'
        ]);
        $this->rating = 5;
        $this->is_active = true;
        $this->sort_order = 0;
        $this->resetValidation();
    }
}
