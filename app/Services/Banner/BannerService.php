<?php

namespace App\Services\Banner;

use App\DTOs\Banner\SaveBannerDTO;
use App\Models\Site\Banner;

class BannerService implements BannerServiceInterface
{
    public function getPaginated(string $search = '', int $perPage = 10)
    {
        return Banner::query()
            ->when($search, fn ($q) => $q->whereLike('title', $search))
            ->orderBy('sort_order')
            ->paginate($perPage);
    }

    public function getById(string $id): Banner
    {
        return Banner::findOrFail($id);
    }

    public function save(SaveBannerDTO $dto): Banner
    {
        // Auto-assign sort_order for new banners
        $sortOrder = $dto->sort_order;
        if (! $dto->id) {
            $sortOrder = (Banner::max('sort_order') ?? 0) + 1;
        }

        return Banner::updateOrCreate(
            ['id' => $dto->id],
            [
                'title'       => $dto->title,
                'subtitle'    => $dto->subtitle,
                'description' => $dto->description,
                'badge_text'  => $dto->badge_text,
                'cta_text'    => $dto->cta_text,
                'cta_url'     => $dto->cta_url,
                'sort_order'  => $sortOrder,
                'image'       => $dto->imagePath,
                'is_active'   => $dto->is_active,
            ]
        );
    }

    public function delete(string $id): bool
    {
        $banner = Banner::findOrFail($id);
        return $banner->delete();
    }
}
