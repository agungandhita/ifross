<?php

namespace App\Services\Addon;

use App\DTOs\Addon\SaveAddonDTO;
use App\Models\Service\AddonItem;

class AddonService implements AddonServiceInterface
{
    public function getPaginated(string $search = '', string $serviceFilter = '', int $perPage = 10)
    {
        return AddonItem::query()
            ->with('service')
            ->when($search, function($q) use ($search) {
                $q->whereLike('name', $search);
            })
            ->when($serviceFilter, function($q) use ($serviceFilter) {
                $q->where('service_id', $serviceFilter);
            })
            ->latest()
            ->paginate($perPage);
    }

    public function getById(string $id): AddonItem
    {
        return AddonItem::findOrFail($id);
    }

    public function save(SaveAddonDTO $dto): AddonItem
    {
        return AddonItem::updateOrCreate(
            ['id' => $dto->id],
            [
                'service_id' => $dto->service_id,
                'name' => $dto->name,
                'price' => $dto->price,
                'unit' => $dto->unit,
                'description' => $dto->description,
                'is_active' => $dto->is_active,
                'sort_order' => $dto->sort_order,
            ]
        );
    }

    public function delete(string $id): bool
    {
        $addon = AddonItem::findOrFail($id);
        return $addon->delete();
    }
}
