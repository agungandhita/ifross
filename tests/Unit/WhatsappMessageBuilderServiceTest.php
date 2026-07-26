<?php

use App\DTOs\Booking\BookingSummaryDTO;
use App\Enums\BookingType;
use App\Enums\ServiceCategory;
use App\Models\Site\SiteSetting;
use App\Services\Whatsapp\WhatsappMessageBuilderService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('builds package message correctly based on settings', function () {
    // Seed setting
    SiteSetting::updateOrCreate(
        ['key' => 'whatsapp_template_package'],
        [
            'value' => "Halo IFROSS MULTIMEDIA,\nService: {service_name}\nPaket: {package_name}\nHarga: {total_price}\nItem Tambahan:\n{addons_list}",
            'label' => 'Template Package',
            'type'  => 'textarea',
        ]
    );

    $summary = new BookingSummaryDTO(
        serviceCategory: ServiceCategory::Multicam->label(),
        bookingType: BookingType::Package->value,
        packageName: 'Paket Basic',
        totalPrice: 4000000,
        items: [
            ['name' => 'Kamera Tambahan', 'qty' => 1, 'unit_price' => 500000, 'subtotal' => 500000]
        ]
    );

    $service = new WhatsappMessageBuilderService();
    $message = $service->buildMessage($summary);

    expect($message)->toContain('Service: Multicamera Live Streaming')
        ->and($message)->toContain('Paket: Paket Basic')
        ->and($message)->toContain('Harga: Rp 4.000.000')
        ->and($message)->toContain('Kamera Tambahan (×1) = Rp 500.000');
});

it('generates correct whatsapp url', function () {
    $service = new WhatsappMessageBuilderService();
    $url = $service->generateWhatsappUrl('0812-5995-6419', 'Halo IFROSS');

    expect($url)->toEqual('https://wa.me/081259956419?text=Halo+IFROSS');
});
