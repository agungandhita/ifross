<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class BannerForm extends Form
{
    use WithFileUploads;

    public ?string $bannerId = null;

    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('nullable|string|max:500')]
    public string $subtitle = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('nullable|string|max:100')]
    public string $badge_text = '';

    #[Validate('nullable|string|max:50')]
    public string $cta_text = '';

    #[Validate('nullable|string|max:255')]
    public string $cta_url = '';

    #[Validate('required|integer|min:0')]
    public int $sort_order = 0;

    #[Validate('boolean')]
    public bool $is_active = true;

    #[Validate('nullable|image|max:2048')]
    public $image;

    public ?string $existingImage = null;

    public function setBanner($banner)
    {
        $this->bannerId      = $banner->id;
        $this->title         = $banner->title;
        $this->subtitle      = $banner->subtitle ?? '';
        $this->description   = $banner->description ?? '';
        $this->badge_text    = $banner->badge_text ?? '';
        $this->cta_text      = $banner->cta_text ?? '';
        $this->cta_url       = $banner->cta_url ?? '';
        $this->sort_order    = $banner->sort_order;
        $this->existingImage = $banner->image;
        $this->is_active     = $banner->is_active;
    }

    public function clear()
    {
        $this->reset([
            'bannerId', 'title', 'subtitle', 'description', 'badge_text',
            'cta_text', 'cta_url', 'image', 'existingImage',
        ]);
        $this->sort_order = 0;
        $this->is_active  = true;
        $this->resetValidation();
    }
}
