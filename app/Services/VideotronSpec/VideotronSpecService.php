<?php

namespace App\Services\VideotronSpec;

use App\DTOs\VideotronSpec\SaveVideotronSpecDTO;
use App\Models\Service\VideotronSpec;

class VideotronSpecService implements VideotronSpecServiceInterface
{
    public function getPaginated(string $search = '', int $perPage = 10)
    {
        return VideotronSpec::query()
            ->when($search, function($q) use ($search) {
                $q->whereLike('brand', $search)
                  ->orWhereLike('model', $search);
            })
            ->latest()
            ->paginate($perPage);
    }

    public function getById(string $id): VideotronSpec
    {
        return VideotronSpec::findOrFail($id);
    }

    public function save(SaveVideotronSpecDTO $dto): VideotronSpec
    {
        return VideotronSpec::updateOrCreate(
            ['id' => $dto->id],
            [
                'brand'                  => $dto->brand,
                'model'                  => $dto->model,
                'power_consumption_watt' => $dto->power_consumption_watt,
                'brightness'             => $dto->brightness,
                'refresh_rate'     => $dto->refresh_rate,
                'panel_width_cm'   => $dto->panel_width_cm,
                'panel_height_cm'  => $dto->panel_height_cm,
                'pixels_per_meter' => $dto->pixels_per_meter,
                'price_per_m2'     => $dto->price_per_m2,
                'type'             => $dto->type,
                'image'            => $dto->image,
                'description'      => $dto->description,
                'is_active'        => $dto->is_active,
            ]
        );
    }

    public function delete(string $id): bool
    {
        $spec = VideotronSpec::findOrFail($id);
        return $spec->delete();
    }
}
