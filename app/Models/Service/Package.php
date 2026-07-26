<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Package extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'service_id',
        'name',
        'slug',
        'price',
        'description',
        'image',
        'features',
        'metadata',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'price'       => 'float',
            'features'    => 'array',
            'metadata'    => 'array',
            'is_active'   => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function promos(): HasMany
    {
        return $this->hasMany(Promo::class);
    }

    /**
     * Relasi ke promo yang sedang aktif (maksimal satu yang berlaku).
     */
    public function activePromo(): HasOne
    {
        return $this->hasOne(Promo::class)->active();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (\Illuminate\Support\Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        $cleanPath = ltrim($this->image, '/');

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
