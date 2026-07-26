<?php

namespace Database\Factories\Service;

use App\Models\Service\VideotronSpec;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideotronSpecFactory extends Factory
{
    protected $model = VideotronSpec::class;

    public function definition(): array
    {
        return [
            'brand' => $this->faker->word(),
            'model' => 'Q3 Pro',
            'power_consumption_watt' => 350,
            'brightness' => 1000,
            'panel_width_cm' => 50,
            'panel_height_cm' => 50,
            'price_per_m2' => 1500000,
            'type' => 'indoor',
            'is_active' => true,
        ];
    }
}
