<?php

namespace Database\Factories\Service;

use App\Models\Service\AddonItem;
use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddonItemFactory extends Factory
{
    protected $model = AddonItem::class;

    public function definition(): array
    {
        return [
            'service_id' => Service::factory(),
            'name' => $this->faker->words(2, true),
            'price' => $this->faker->numberBetween(100000, 1000000),
            'unit' => 'unit',
            'is_active' => true,
        ];
    }
}
