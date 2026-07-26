<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class PackageForm extends Form
{
    public ?string $packageId = null;

    #[Validate('required|exists:services,id')]
    public string $service_id = '';

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|numeric|min:0')]
    public $price = ''; // use string/mixed to handle form input natively, but validated as numeric

    #[Validate('required|string')]
    public string $description = '';

    #[Validate('nullable|string')]
    public string $features = '';

    #[Validate('nullable|string')]
    public string $metadata = '';

    #[Validate('nullable|integer|min:0')]
    public int $sort_order = 0;

    #[Validate('boolean')]
    public bool $is_active = true;

    #[Validate('boolean')]
    public bool $is_featured = false;

    #[Validate('nullable|image|max:2048')]
    public $image;

    public ?string $existingImage = null;

    public function setPackage($package)
    {
        $this->packageId = $package->id;
        $this->service_id = (string) $package->service_id;
        $this->name = $package->name;
        $this->price = (string) $package->price;
        $this->description = $package->description;
        $this->features = $package->features ? implode("\n", $package->features) : '';
        $this->sort_order = $package->sort_order;
        
        $metaStr = '';
        if ($package->metadata) {
            foreach ($package->metadata as $k => $v) {
                $metaStr .= "$k: $v\n";
            }
        }
        $this->metadata = trim($metaStr);

        $this->existingImage = $package->image;
        $this->is_active = $package->is_active;
        $this->is_featured = $package->is_featured;
    }

    public function clear()
    {
        $this->reset([
            'packageId', 'service_id', 'name', 'price', 
            'description', 'features', 'metadata', 'image', 'existingImage'
        ]);
        $this->sort_order = 0;
        $this->is_active = true;
        $this->is_featured = false;
        $this->resetValidation();
    }
}
