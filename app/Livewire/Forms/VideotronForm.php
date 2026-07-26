<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class VideotronForm extends Form
{
    public ?string $specId = null;

    #[Validate('required|string|max:255')]
    public string $brand = '';

    #[Validate('nullable|string|max:255')]
    public string $model = '';

    #[Validate('required|integer|min:0')]
    public $power_consumption_watt = 350;

    #[Validate('required|integer|min:0')]
    public $brightness = 5000;

    #[Validate('required|integer|min:0')]
    public $refresh_rate = 3840;

    #[Validate('required|numeric|min:1')]
    public $panel_width_cm = '50';

    #[Validate('required|numeric|min:1')]
    public $panel_height_cm = '50';

    #[Validate('required|integer|min:1')]
    public $pixels_per_meter = 256;

    #[Validate('required|numeric|min:0')]
    public $price_per_m2 = '';

    #[Validate('required|string|in:indoor,outdoor')]
    public string $type = 'indoor';

    #[Validate('nullable|image|max:2048')]
    public $image;

    public ?string $existing_image = null;

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('boolean')]
    public bool $is_active = true;

    public function setSpec($spec)
    {
        $this->specId                 = $spec->id;
        $this->brand                  = $spec->brand;
        $this->model                  = $spec->model ?? '';
        $this->power_consumption_watt = (string) ($spec->power_consumption_watt ?? 350);
        $this->brightness             = (string) $spec->brightness;
        $this->refresh_rate           = (string) ($spec->refresh_rate ?? 3840);
        $this->panel_width_cm         = (string) $spec->panel_width_cm;
        $this->panel_height_cm        = (string) $spec->panel_height_cm;
        $this->pixels_per_meter       = (string) ($spec->pixels_per_meter ?? 256);
        $this->price_per_m2           = (string) $spec->price_per_m2;
        $this->type                   = $spec->type;
        $this->existing_image         = $spec->image;
        $this->description            = $spec->description ?? '';
        $this->is_active              = $spec->is_active;
    }

    public function clear()
    {
        $this->reset([
            'specId', 'brand', 'model', 'power_consumption_watt', 'brightness', 'refresh_rate',
            'panel_width_cm', 'panel_height_cm', 'pixels_per_meter', 'price_per_m2', 
            'image', 'existing_image', 'description'
        ]);
        $this->power_consumption_watt = 350;
        $this->brightness             = 5000;
        $this->refresh_rate           = 3840;
        $this->pixels_per_meter       = 256;
        $this->type                   = 'indoor';
        $this->is_active              = true;
        $this->resetValidation();
    }
}
