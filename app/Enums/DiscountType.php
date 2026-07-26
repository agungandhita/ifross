<?php

namespace App\Enums;

enum DiscountType: string
{
    case Percentage = 'percentage';
    case Fixed      = 'fixed';

    public function label(): string
    {
        return match ($this) {
            self::Percentage => 'Persentase (%)',
            self::Fixed      => 'Nominal (Rp)',
        };
    }

    public function shortLabel(): string
    {
        return match ($this) {
            self::Percentage => '%',
            self::Fixed      => 'Rp',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Percentage => 'orange',
            self::Fixed      => 'blue',
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::Percentage => 'bg-orange-100 text-orange-700 border-orange-200',
            self::Fixed      => 'bg-blue-100 text-blue-700 border-blue-200',
        };
    }
}
