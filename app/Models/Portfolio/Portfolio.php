<?php

namespace App\Models\Portfolio;

use App\Enums\ServiceCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'location',
        'event_date',
        'client_name',
        'images',
        'thumbnail',
        'video_url',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'category'    => ServiceCategory::class,
            'images'      => 'array',
            'event_date'  => 'date',
            'is_featured' => 'boolean',
            'is_active'   => 'boolean',
        ];
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class)->where('is_active', true);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory(Builder $query, ServiceCategory $category): Builder
    {
        return $query->where('category', $category->value);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('event_date');
    }

    public function getFirstImageAttribute(): ?string
    {
        return $this->thumbnail_url;
    }

    public function getImageUrlsAttribute(): array
    {
        $list = [];

        if (is_array($this->images) && ! empty($this->images)) {
            foreach ($this->images as $img) {
                if ($img) {
                    $list[] = $this->formatImageUrl($img);
                }
            }
        }

        if (empty($list) && $this->thumbnail) {
            $list[] = $this->formatImageUrl($this->thumbnail);
        }

        return $list;
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        if ($this->thumbnail) {
            return $this->formatImageUrl($this->thumbnail);
        }

        $urls = $this->image_urls;

        return $urls[0] ?? null;
    }

    private function formatImageUrl(string $path): string
    {
        if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $cleanPath = ltrim($path, '/');

        if (\Illuminate\Support\Str::startsWith($cleanPath, 'storage/')) {
            return asset($cleanPath);
        }

        return asset('storage/' . $cleanPath);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
