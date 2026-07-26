<?php

namespace Database\Factories\Service;

use App\Models\Service\Package;
use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition(): array
    {
        return [
            'service_id' => Service::factory(),
            'name' => $this->faker->words(3, true),
            'slug' => $this->faker->unique()->slug(),
            'price' => $this->faker->numberBetween(1000000, 10000000),
            'is_active' => true,
        ];
    }
}
