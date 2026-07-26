<?php

namespace App\Livewire\Forms;

use App\Enums\ServiceCategory;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PortfolioForm extends Form
{

    public ?string $portfolioId = null;

    #[Validate('required|string|max:255')]
    public string $title = '';

    public string $slug = '';

    public string $category = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('nullable|string|max:255')]
    public string $location = '';

    #[Validate('nullable|date')]
    public ?string $event_date = null;

    #[Validate('nullable|string|max:255')]
    public string $client_name = '';

    public array $images = [];

    public ?string $thumbnail = null;

    #[Validate('nullable|string|max:255')]
    public string $video_url = '';

    #[Validate('nullable|image|max:2048')]
    public $newMedia;

    #[Validate('boolean')]
    public bool $is_active = true;

    #[Validate('boolean')]
    public bool $is_featured = false;

    #[Validate('required|integer|min:0')]
    public int $sort_order = 0;

    public function rules()
    {
        return [
            'category' => ['required', Rule::in(array_map(fn($c) => $c->value, ServiceCategory::cases()))],
        ];
    }

    public function setPortfolio($portfolio)
    {
        $this->portfolioId = $portfolio->id;
        $this->title = $portfolio->title;
        $this->slug = $portfolio->slug ?? '';
        $this->category = $portfolio->category->value;
        $this->description = $portfolio->description ?? '';
        $this->location = $portfolio->location ?? '';
        $this->event_date = $portfolio->event_date ? \Carbon\Carbon::parse($portfolio->event_date)->format('Y-m-d') : null;
        $this->client_name = $portfolio->client_name ?? '';
        $this->images = $portfolio->images ?? [];
        $this->thumbnail = $portfolio->thumbnail;
        $this->video_url = $portfolio->video_url ?? '';
        $this->is_active = $portfolio->is_active;
        $this->is_featured = $portfolio->is_featured;
        $this->sort_order = $portfolio->sort_order;
    }

    public function clear()
    {
        $this->reset([
            'portfolioId', 'title', 'slug', 'category', 'description', 'location', 'event_date', 'client_name', 'images', 'thumbnail', 'video_url', 'newMedia'
        ]);
        $this->is_active = true;
        $this->is_featured = false;
        $this->sort_order = 0;
        $this->resetValidation();
    }
}
