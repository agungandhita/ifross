<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class VideotronSpec extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'power_consumption_watt',
        'brightness',
        'refresh_rate',
        'panel_width_cm',
        'panel_height_cm',
        'pixels_per_meter',
        'price_per_m2',
        'type',
        'image',
        'description',
        'is_active',
    ];

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'power_consumption_watt' => 'integer',
            'brightness'             => 'integer',
            'refresh_rate'           => 'integer',
            'panel_width_cm'         => 'float',
            'panel_height_cm'        => 'float',
            'pixels_per_meter'       => 'integer',
            'price_per_m2'           => 'float',
            'is_active'              => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeIndoor(Builder $query): Builder
    {
        return $query->where('type', 'indoor');
    }

    public function scopeOutdoor(Builder $query): Builder
    {
        return $query->where('type', 'outdoor');
    }

    public function getDisplayNameAttribute(): string
    {
        return "{$this->brand} {$this->model} ({$this->type})";
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

    /**
     * Hitung jumlah panel horizontal yang dibutuhkan untuk lebar tertentu.
     */
    public function panelsHorizontal(float $widthM): int
    {
        $panelWidthM = $this->panel_width_cm / 100;

        return (int) ceil($widthM / $panelWidthM);
    }

    /**
     * Hitung jumlah panel vertikal yang dibutuhkan untuk tinggi tertentu.
     */
    public function panelsVertical(float $heightM): int
    {
        $panelHeightM = $this->panel_height_cm / 100;

        return (int) ceil($heightM / $panelHeightM);
    }
}
