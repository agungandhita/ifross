<?php

namespace App\Services\Package;

use App\DTOs\Package\SavePackageDTO;
use App\Models\Service\Package;
use Illuminate\Support\Str;

class PackageService implements PackageServiceInterface
{
    public function getPaginated(string $search = '', string $serviceFilter = '', int $perPage = 10)
    {
        return Package::query()
            ->with('service')
            ->when($search, function($q) use ($search) {
                $q->whereLike('name', $search);
            })
            ->when($serviceFilter, function($q) use ($serviceFilter) {
                $q->where('service_id', $serviceFilter);
            })
            ->latest('updated_at')
            ->paginate($perPage);
    }

    public function getById(string $id): Package
    {
        return Package::findOrFail($id);
    }

    public function save(SavePackageDTO $dto): Package
    {
        // Generate unique slug if creating or name changed
        $slug = Str::slug($dto->name);
        $baseSlug = $slug;
        $count = 1;
        while (Package::where('slug', $slug)->when($dto->id, fn($q) => $q->where('id', '!=', $dto->id))->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        return Package::updateOrCreate(
            ['id' => $dto->id],
            [
                'service_id' => $dto->service_id,
                'name' => $dto->name,
                'slug' => $slug,
                'price' => $dto->price,
                'description' => $dto->description,
                'features' => empty($dto->features) ? null : $dto->features,
                'metadata' => empty($dto->metadata) ? null : $dto->metadata,
                'image' => $dto->imagePath,
                'sort_order' => $dto->sort_order,
                'is_active' => $dto->is_active,
                'is_featured' => $dto->is_featured,
            ]
        );
    }

    public function delete(string $id): bool
    {
        $package = Package::findOrFail($id);
        return $package->delete();
    }
}
