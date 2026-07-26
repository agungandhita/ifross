<?php

namespace App\Services\Portfolio;

use App\DTOs\Portfolio\SavePortfolioDTO;
use App\Models\Portfolio\Portfolio;
use Illuminate\Support\Str;

class PortfolioService implements PortfolioServiceInterface
{
    public function getPaginated(string $search = '', string $categoryFilter = '', int $perPage = 10)
    {
        return Portfolio::query()
            ->when($search, function($q) use ($search) {
                $q->whereLike('title', $search)
                  ->orWhereLike('location', $search);
            })
            ->when($categoryFilter, function($q) use ($categoryFilter) {
                $q->where('category', $categoryFilter);
            })
            ->latest()
            ->paginate($perPage);
    }

    public function getById(string $id): Portfolio
    {
        return Portfolio::findOrFail($id);
    }

    public function save(SavePortfolioDTO $dto): Portfolio
    {
        $slug = Str::slug($dto->title);
        $baseSlug = $slug;
        $count = 1;
        while (Portfolio::where('slug', $slug)->when($dto->id, fn($q) => $q->where('id', '!=', $dto->id))->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        return Portfolio::updateOrCreate(
            ['id' => $dto->id],
            [
                'title' => $dto->title,
                'slug' => $slug,
                'category' => $dto->category,
                'description' => $dto->description,
                'location' => $dto->location,
                'event_date' => $dto->event_date,
                'client_name' => $dto->client_name,
                'images' => $dto->images,
                'thumbnail' => $dto->thumbnail,
                'video_url' => $dto->video_url,
                'is_active' => $dto->is_active,
                'is_featured' => $dto->is_featured,
                'sort_order' => $dto->sort_order,
            ]
        );
    }

    public function getAllForDropdown(): \Illuminate\Database\Eloquent\Collection
    {
        return Portfolio::query()
            ->orderBy('title')
            ->get(['id', 'title', 'client_name', 'event_date']);
    }

    public function delete(string $id): bool
    {
        $portfolio = Portfolio::findOrFail($id);
        return $portfolio->delete();
    }
}
