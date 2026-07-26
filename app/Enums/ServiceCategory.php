<?php

namespace App\Enums;

enum ServiceCategory: string
{
    case Multicam  = 'multicam';
    case Videotron = 'videotron';
    case Lighting  = 'lighting';

    public function label(): string
    {
        return match ($this) {
            self::Multicam  => 'Multicamera Live Streaming',
            self::Videotron => 'LED Videotron',
            self::Lighting  => 'Lighting & Tata Cahaya',
        };
    }

    public function shortLabel(): string
    {
        return match ($this) {
            self::Multicam  => 'Multicam',
            self::Videotron => 'Videotron',
            self::Lighting  => 'Lighting',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Multicam  => 'primary',
            self::Videotron => 'accent-brand',
            self::Lighting  => 'primary-dark',
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::Multicam  => 'bg-primary-light text-primary-dark',
            self::Videotron => 'bg-accent-brand/10 text-accent-brand',
            self::Lighting  => 'bg-primary-light text-primary-dark',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Multicam  => 'video-camera',
            self::Videotron => 'tv',
            self::Lighting  => 'light-bulb',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Multicam  => 'Layanan live streaming profesional dengan multi kamera, cocok untuk seminar, konser, pernikahan, dan event korporat.',
            self::Videotron => 'Sewa LED Videotron berbagai ukuran untuk display visual yang menakjubkan di indoor maupun outdoor.',
            self::Lighting  => 'Tata cahaya profesional untuk mempercantik panggung dan memberikan atmosfer terbaik pada event Anda.',
        };
    }

    public function slug(): string
    {
        return $this->value;
    }
}
