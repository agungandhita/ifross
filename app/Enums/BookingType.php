<?php

namespace App\Enums;

enum BookingType: string
{
    case Package = 'package';
    case Custom  = 'custom';

    public function label(): string
    {
        return match ($this) {
            self::Package => 'Paket Ready',
            self::Custom  => 'Custom / Hitung Manual',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Package => 'Pilih dari paket bundling yang sudah tersedia dengan harga tetap.',
            self::Custom  => 'Rakit kebutuhan Anda sendiri — pilih item satuan dan hitung estimasi harga.',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Package => 'primary',
            self::Custom  => 'accent',
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::Package => 'bg-primary-light text-primary-dark',
            self::Custom  => 'bg-accent/10 text-accent',
        };
    }
}
