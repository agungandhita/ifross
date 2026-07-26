<?php

namespace App\DTOs\Booking;

readonly class BookingSummaryDTO
{
    /**
     * @param array<int, array{name: string, qty: int, unit_price: float, subtotal: float}> $items
     */
    public function __construct(
        public string  $serviceCategory,
        public string  $bookingType,
        public ?string $packageName,
        public float   $totalPrice,
        public array   $items,
        public string  $notes = '',
        public ?string $videotronWidth     = null,
        public ?string $videotronHeight    = null,
        public ?string $videotronResolution = null,
        public ?string $videotronPowerConsumption = null,
        public ?string $videotronSpecName  = null,
        public ?string $eventDate          = null,
        public ?string $eventLocation      = null,
    ) {}

    public function getFormattedTotal(): string
    {
        return 'Rp ' . number_format($this->totalPrice, 0, ',', '.');
    }
}
