<?php

namespace Database\Factories\Service;

use App\Models\Service\Service;
use App\Enums\ServiceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'slug' => $this->faker->unique()->slug(),
            'category' => ServiceCategory::Multicam->value,
            'description' => $this->faker->paragraph(),
            'short_description' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }
}
