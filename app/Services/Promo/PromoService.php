<?php

namespace App\Services\Promo;

use App\DTOs\Promo\SavePromoDTO;
use App\Models\Service\Promo;

class PromoService implements PromoServiceInterface
{
    public function getPaginated(string $search = '', string $packageFilter = '', int $perPage = 10)
    {
        return Promo::query()
            ->with('package.service')
            ->when($search, function ($q) use ($search) {
                $q->whereLike('name', $search);
            })
            ->when($packageFilter, function ($q) use ($packageFilter) {
                $q->where('package_id', $packageFilter);
            })
            ->latest()
            ->paginate($perPage);
    }

    public function getById(string $id): Promo
    {
        return Promo::with('package')->findOrFail($id);
    }

    public function save(SavePromoDTO $dto): Promo
    {
        return Promo::updateOrCreate(
            ['id' => $dto->id],
            [
                'package_id'     => $dto->package_id,
                'name'           => $dto->name,
                'description'    => $dto->description,
                'discount_type'  => $dto->discount_type,
                'discount_value' => $dto->discount_value,
                'starts_at'      => $dto->starts_at ?: null,
                'ends_at'        => $dto->ends_at ?: null,
                'is_active'      => $dto->is_active,
            ]
        );
    }

    public function delete(string $id): bool
    {
        $promo = Promo::findOrFail($id);
        return (bool) $promo->delete();
    }

    public function getActivePromoForPackage(string $packageId): ?Promo
    {
        return Promo::query()
            ->where('package_id', $packageId)
            ->active()
            ->first();
    }
}
