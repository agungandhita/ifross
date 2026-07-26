<?php

namespace App\Enums;

enum SettingType: string
{
    case Text     = 'text';
    case Number   = 'number';
    case Email    = 'email';
    case Textarea = 'textarea';
    case Json     = 'json';
    case Boolean  = 'boolean';

    public function label(): string
    {
        return match ($this) {
            self::Text     => 'Teks',
            self::Number   => 'Angka',
            self::Email    => 'Email',
            self::Textarea => 'Teks Panjang',
            self::Json     => 'JSON',
            self::Boolean  => 'Ya/Tidak',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Text     => 'gray',
            self::Number   => 'blue',
            self::Email    => 'indigo',
            self::Textarea => 'purple',
            self::Json     => 'orange',
            self::Boolean  => 'green',
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::Text     => 'bg-gray-100 text-gray-700',
            self::Number   => 'bg-blue-100 text-blue-700',
            self::Email    => 'bg-indigo-100 text-indigo-700',
            self::Textarea => 'bg-purple-100 text-purple-700',
            self::Json     => 'bg-orange-100 text-orange-700',
            self::Boolean  => 'bg-green-100 text-green-700',
        };
    }
}
