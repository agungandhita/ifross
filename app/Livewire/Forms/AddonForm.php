<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class AddonForm extends Form
{
    public ?string $addonId = null;

    #[Validate('required|exists:services,id')]
    public string $service_id = '';

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|numeric|min:0')]
    public $price = '';

    #[Validate('required|string|max:50')]
    public string $unit = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('boolean')]
    public bool $is_active = true;

    #[Validate('required|integer|min:0')]
    public int $sort_order = 0;

    public function setAddon($addon)
    {
        $this->addonId = $addon->id;
        $this->service_id = (string) $addon->service_id;
        $this->name = $addon->name;
        $this->price = (string) $addon->price;
        $this->unit = $addon->unit;
        $this->description = $addon->description ?? '';
        $this->is_active = $addon->is_active;
        $this->sort_order = $addon->sort_order;
    }

    public function clear()
    {
        $this->reset(['addonId', 'service_id', 'name', 'price', 'unit', 'description']);
        $this->is_active = true;
        $this->sort_order = 0;
        $this->resetValidation();
    }
}
