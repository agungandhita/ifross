<?php

namespace App\Livewire\Forms;

use App\Enums\DiscountType;
use App\Models\Service\Promo;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PromoForm extends Form
{
    public ?string $promoId = null;

    #[Validate('required|exists:packages,id')]
    public string $package_id = '';

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string|max:500')]
    public string $description = '';

    #[Validate('required|in:percentage,fixed')]
    public string $discount_type = 'percentage';

    #[Validate('required|numeric|min:0.01')]
    public $discount_value = '';

    #[Validate('nullable|date')]
    public string $starts_at = '';

    #[Validate('nullable|date|after_or_equal:starts_at')]
    public string $ends_at = '';

    #[Validate('boolean')]
    public bool $is_active = true;

    public function setPromo(Promo $promo): void
    {
        $this->promoId       = $promo->id;
        $this->package_id    = (string) $promo->package_id;
        $this->name          = $promo->name;
        $this->description   = $promo->description ?? '';
        $this->discount_type = $promo->discount_type instanceof DiscountType
            ? $promo->discount_type->value
            : (string) $promo->discount_type;
        $this->discount_value = (string) $promo->discount_value;
        $this->starts_at      = $promo->starts_at ? $promo->starts_at->format('Y-m-d\TH:i') : '';
        $this->ends_at        = $promo->ends_at ? $promo->ends_at->format('Y-m-d\TH:i') : '';
        $this->is_active      = $promo->is_active;
    }

    public function clear(): void
    {
        $this->reset([
            'promoId', 'package_id', 'name', 'description',
            'discount_type', 'discount_value', 'starts_at', 'ends_at',
        ]);
        $this->discount_type = 'percentage';
        $this->is_active     = true;
        $this->resetValidation();
    }
}
