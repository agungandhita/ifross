<?php

namespace Database\Seeders;

use App\Enums\SettingType;
use App\Models\Site\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // ─── Kontak ──────────────────────────────
            [
                'key'         => 'whatsapp_number',
                'value'       => '6281259956419',
                'type'        => SettingType::Text->value,
                'label'       => 'Nomor WhatsApp Tujuan',
                'group'       => 'contact',
                'description' => 'Nomor WhatsApp yang akan dihubungi saat customer klik tombol pesan.',
            ],
            [
                'key'         => 'company_address',
                'value'       => 'Laren, Lamongan, Jawa Timur',
                'type'        => SettingType::Textarea->value,
                'label'       => 'Alamat Perusahaan',
                'group'       => 'contact',
                'description' => 'Alamat lengkap yang ditampilkan di footer dan halaman kontak.',
            ],
            [
                'key'         => 'company_phone',
                'value'       => '081259956419',
                'type'        => SettingType::Text->value,
                'label'       => 'Nomor Telepon',
                'group'       => 'contact',
                'description' => 'Nomor telepon yang ditampilkan di footer.',
            ],
            [
                'key'         => 'company_email',
                'value'       => 'info@ifrossmultimedia.com',
                'type'        => SettingType::Text->value,
                'label'       => 'Email Perusahaan',
                'group'       => 'contact',
                'description' => 'Email yang ditampilkan di footer.',
            ],
            [
                'key'         => 'operational_hours',
                'value'       => 'Senin–Sabtu: 08.00–17.00 WIB',
                'type'        => SettingType::Text->value,
                'label'       => 'Jam Operasional',
                'group'       => 'contact',
                'description' => 'Jam operasional yang ditampilkan di footer.',
            ],

            // ─── Sosial Media ─────────────────────────
            [
                'key'         => 'social_instagram',
                'value'       => 'https://instagram.com/ifrossmultimedia',
                'type'        => SettingType::Text->value,
                'label'       => 'Instagram URL',
                'group'       => 'social',
                'description' => 'Link profil Instagram.',
            ],
            [
                'key'         => 'social_facebook',
                'value'       => '',
                'type'        => SettingType::Text->value,
                'label'       => 'Facebook URL',
                'group'       => 'social',
                'description' => 'Link profil Facebook.',
            ],
            [
                'key'         => 'social_youtube',
                'value'       => '',
                'type'        => SettingType::Text->value,
                'label'       => 'YouTube URL',
                'group'       => 'social',
                'description' => 'Link channel YouTube.',
            ],

            // ─── WhatsApp Template ─────────────────────
            [
                'key'         => 'whatsapp_template_package',
                'value'       => "Halo IFROSS MULTIMEDIA,\n\nSaya tertarik memesan layanan berikut:\n\n*Layanan:* {service_name}\n*Paket:* {package_name}\n*Harga Paket:* {package_price}\n\n{addons_list}\n\n*Total Estimasi:* {total_price}\n\n*Tanggal Event:* {event_date}\n*Lokasi:* {event_location}\n\nMohon konfirmasi ketersediaan. Terima kasih!",
                'type'        => SettingType::Textarea->value,
                'label'       => 'Template Pesan WA — Paket Ready',
                'group'       => 'whatsapp',
                'description' => 'Template pesan WhatsApp untuk pemesanan paket ready. Gunakan variabel: {service_name}, {package_name}, {package_price}, {addons_list}, {total_price}, {event_date}, {event_location}.',
            ],
            [
                'key'         => 'whatsapp_template_custom',
                'value'       => "Halo IFROSS MULTIMEDIA,\n\nSaya ingin kalkulasi harga custom untuk:\n\n*Layanan:* {service_name}\n*Mode:* Custom\n\n{items_list}\n\n*Total Estimasi:* {total_price}\n\n*Tanggal Event:* {event_date}\n*Lokasi:* {event_location}\n\nMohon konfirmasi ketersediaan. Terima kasih!",
                'type'        => SettingType::Textarea->value,
                'label'       => 'Template Pesan WA — Custom',
                'group'       => 'whatsapp',
                'description' => 'Template pesan WhatsApp untuk pemesanan custom. Gunakan variabel: {service_name}, {items_list}, {total_price}, {event_date}, {event_location}.',
            ],
            [
                'key'         => 'whatsapp_template_videotron',
                'value'       => "Halo IFROSS MULTIMEDIA,\n\nSaya ingin pesan Videotron dengan spesifikasi:\n\n*Tipe LED:* {spec_name}\n*Ukuran:* {width}m × {height}m\n*Estimasi Resolusi:* {resolution}\n\n{addons_list}\n\n*Total Estimasi:* {total_price}\n\n*Tanggal Event:* {event_date}\n*Lokasi:* {event_location}\n\nMohon konfirmasi ketersediaan. Terima kasih!",
                'type'        => SettingType::Textarea->value,
                'label'       => 'Template Pesan WA — Videotron Custom',
                'group'       => 'whatsapp',
                'description' => 'Template pesan WhatsApp untuk pemesanan videotron custom. Gunakan variabel: {service_name}, {width}, {height}, {resolution}, {spec_name}, {addons_list}, {total_price}, {event_date}, {event_location}.',
            ],

            // ─── Pricing ─────────────────────────────
            [
                'key'         => 'videotron_min_price_per_m2',
                'value'       => '1500000',
                'type'        => SettingType::Number->value,
                'label'       => 'Harga Minimum Videotron per m² (Rp)',
                'group'       => 'pricing',
                'description' => 'Harga sewa LED Videotron per m² minimum. Dipakai sebagai fallback kalkulasi.',
            ],
            [
                'key'         => 'genset_price_default',
                'value'       => '500000',
                'type'        => SettingType::Number->value,
                'label'       => 'Harga Genset Default (Rp)',
                'group'       => 'pricing',
                'description' => 'Harga sewa genset default per hari jika tidak ada addon khusus.',
            ],

            // ─── SEO ────────────────────────────────
            [
                'key'         => 'meta_title',
                'value'       => 'IFROSS MULTIMEDIA — Sewa Multicamera, LED Videotron & Lighting Lamongan',
                'type'        => SettingType::Text->value,
                'label'       => 'Meta Title Default',
                'group'       => 'seo',
                'description' => 'Judul halaman default untuk SEO.',
            ],
            [
                'key'         => 'meta_description',
                'value'       => 'IFROSS MULTIMEDIA menyediakan layanan sewa Multicamera Live Streaming, LED Videotron, dan Lighting profesional di Laren, Lamongan. Harga transparan, kualitas terjamin.',
                'type'        => SettingType::Textarea->value,
                'label'       => 'Meta Description Default',
                'group'       => 'seo',
                'description' => 'Deskripsi halaman default untuk SEO. Maks 160 karakter.',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
