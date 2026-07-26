<?php

namespace App\Models\Service;

use App\Enums\DiscountType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Promo extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'package_id',
        'name',
        'description',
        'discount_type',
        'discount_value',
        'starts_at',
        'ends_at',
        'is_active',
    ];

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'discount_type'  => DiscountType::class,
            'discount_value' => 'float',
            'is_active'      => 'boolean',
            'starts_at'      => 'datetime',
            'ends_at'        => 'datetime',
        ];
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Scope: promo aktif (is_active = true dan masih dalam rentang tanggal).
     */
    public function scopeActive(Builder $query): Builder
    {
        $now = Carbon::now();

        return $query
            ->where('is_active', true)
            ->where(function (Builder $q) use ($now) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
            })
            ->where(function (Builder $q) use ($now) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
            });
    }

    /**
     * Hitung harga setelah diskon diterapkan.
     */
    public function getDiscountedPrice(float $basePrice): float
    {
        if ($this->discount_type === DiscountType::Percentage) {
            $discounted = $basePrice - ($basePrice * $this->discount_value / 100);
        } else {
            $discounted = $basePrice - $this->discount_value;
        }

        return max(0, $discounted);
    }

    /**
     * Format tampilan nilai diskon.
     */
    public function getFormattedDiscount(): string
    {
        if ($this->discount_type === DiscountType::Percentage) {
            return number_format($this->discount_value, 0) . '%';
        }

        return 'Rp ' . number_format($this->discount_value, 0, ',', '.');
    }

    /**
     * Apakah promo ini sedang berlaku (aktif dan dalam rentang tanggal)?
     */
    public function isCurrentlyActive(): bool
    {
        if (! $this->is_active) {
            return false;
        }

        $now = Carbon::now();

        if ($this->starts_at && $this->starts_at->gt($now)) {
            return false;
        }

        if ($this->ends_at && $this->ends_at->lt($now)) {
            return false;
        }

        return true;
    }
}
