<?php

namespace App\Services\Whatsapp;

use App\DTOs\Booking\BookingSummaryDTO;
use App\Enums\BookingType;
use App\Models\Site\SiteSetting;

class WhatsappMessageBuilderService implements WhatsappMessageBuilderServiceInterface
{
    /**
     * Build pesan WhatsApp berformat dari booking summary.
     * Template diambil dari site_settings — tidak ada hardcode.
     */
    public function buildMessage(BookingSummaryDTO $summary): string
    {
        $templateKey = $this->resolveTemplateKey($summary);
        $template    = SiteSetting::get($templateKey, $this->defaultTemplate($summary));

        $addonsText = $this->buildAddonsText($summary);

        $message = str_replace(
            [
                '{service_name}',
                '{package_name}',
                '{package_price}',
                '{addons_list}',
                '{items_list}',
                '{total_price}',
                '{width}',
                '{height}',
                '{resolution}',
                '{power_consumption}',
                '{spec_name}',
                '{event_date}',
                '{event_location}',
            ],
            [
                $summary->serviceCategory,
                $summary->packageName ?? '-',
                $this->formatPrice($summary->totalPrice),
                $addonsText,
                $addonsText,
                $this->formatPrice($summary->totalPrice),
                $summary->videotronWidth ?? '-',
                $summary->videotronHeight ?? '-',
                $summary->videotronResolution ?? '-',
                $summary->videotronPowerConsumption ?? '-',
                $summary->videotronSpecName ?? '-',
                $summary->eventDate ?? '[isi tanggal]',
                $summary->eventLocation ?? '[isi lokasi]',
            ],
            $template
        );

        // Clean up excessive newlines if addons list is empty
        $message = preg_replace("/\n{3,}/", "\n\n", $message);

        return trim($message);
    }

    /**
     * Generate URL wa.me dengan pesan yang sudah di-encode.
     */
    public function generateWhatsappUrl(string $phoneNumber, string $message): string
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $phoneNumber);
        $encoded    = urlencode($message);

        return "https://wa.me/{$cleanPhone}?text={$encoded}";
    }

    /**
     * Tentukan kunci template setting berdasarkan tipe booking.
     */
    private function resolveTemplateKey(BookingSummaryDTO $summary): string
    {
        if ($summary->bookingType === BookingType::Custom->value && $summary->videotronWidth !== null) {
            return 'whatsapp_template_videotron';
        }

        if ($summary->bookingType === BookingType::Custom->value) {
            return 'whatsapp_template_custom';
        }

        return 'whatsapp_template_package';
    }

    /**
     * Build teks daftar addon/item untuk pesan WA.
     */
    private function buildAddonsText(BookingSummaryDTO $summary): string
    {
        if (empty($summary->items)) {
            return '';
        }

        $lines = [];

        foreach ($summary->items as $item) {
            $lines[] = "• {$item['name']} (×{$item['qty']}) = " . $this->formatPrice($item['subtotal']);
        }

        if (! empty($lines)) {
            return "+ *Item Tambahan:*\n" . implode("\n", $lines);
        }

        return '';
    }

    /**
     * Format angka ke format Rupiah.
     */
    private function formatPrice(float $price): string
    {
        return 'Rp ' . number_format($price, 0, ',', '.');
    }

    /**
     * Default template sebagai fallback jika setting kosong.
     */
    private function defaultTemplate(BookingSummaryDTO $summary): string
    {
        return "Halo IFROSS MULTIMEDIA,\n\nSaya tertarik memesan:\n\n*Layanan:* {service_name}\n{addons_list}\n\n*Total Estimasi:* {total_price}\n\n*Tanggal Event:* {event_date}\n*Lokasi:* {event_location}\n\nMohon konfirmasi. Terima kasih!";
    }
}
