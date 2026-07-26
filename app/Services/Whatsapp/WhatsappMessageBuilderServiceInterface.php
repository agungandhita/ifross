<?php

namespace App\Services\Whatsapp;

use App\DTOs\Booking\BookingSummaryDTO;
use App\Enums\BookingType;

interface WhatsappMessageBuilderServiceInterface
{
    /**
     * Build pesan WhatsApp berformat dari booking summary.
     */
    public function buildMessage(BookingSummaryDTO $summary): string;

    /**
     * Generate URL wa.me dengan pesan yang sudah terformat.
     */
    public function generateWhatsappUrl(string $phoneNumber, string $message): string;
}
