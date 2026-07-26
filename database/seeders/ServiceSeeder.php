<?php

namespace Database\Seeders;

use App\Enums\ServiceCategory;
use App\Models\Service\AddonItem;
use App\Models\Service\Package;
use App\Models\Service\Service;
use App\Models\Service\VideotronSpec;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // ─── 1. MULTICAMERA LIVE STREAMING ───────────────────────────────
        $multicam = Service::updateOrCreate(
            ['category' => ServiceCategory::Multicam->value],
            [
                'name'              => 'Multicamera Live Streaming',
                'slug'              => 'multicamera-live-streaming',
                'category'          => ServiceCategory::Multicam->value,
                'short_description' => 'Live streaming profesional dengan multi kamera, cocok untuk seminar, konser, pernikahan, dan event korporat.',
                'description'       => 'Layanan Multicamera Live Streaming IFROSS MULTIMEDIA menghadirkan produksi video live berkualitas broadcast. Dengan teknologi switching profesional, operator berpengalaman, dan koneksi internet dedicated, event Anda akan disiarkan dengan sempurna ke berbagai platform digital.',
                'icon'              => 'video-camera',
                'hero_image'        => null,
                'is_active'         => true,
                'sort_order'        => 1,
            ]
        );

        $multicamPackages = [
            [
                'name'        => 'Paket Basic Streaming',
                'slug'        => 'multicam-basic',
                'price'       => 3500000,
                'description' => 'Cocok untuk webinar, podcast, dan acara kecil. 2 kamera, output ke 1 platform streaming.',
                'features'    => [
                    '2 Kamera Profesional',
                    'Live Switching',
                    'Output ke YouTube / Facebook / Zoom',
                    '1 Operator',
                    'Durasi max 4 jam',
                    'Internet Dedicated 10 Mbps',
                ],
                'metadata'    => ['cameras' => 2, 'platforms' => 1, 'crew' => 1, 'max_hours' => 4],
                'is_featured' => false,
                'sort_order'  => 1,
            ],
            [
                'name'        => 'Paket Standard Streaming',
                'slug'        => 'multicam-standard',
                'price'       => 6500000,
                'description' => 'Ideal untuk seminar, pelatihan, dan gathering. 3 kamera, output multi-platform.',
                'features'    => [
                    '3 Kamera Profesional',
                    'Live Switching + Mixing Audio',
                    'Output ke 2 Platform Sekaligus',
                    '2 Operator + 1 Audio Engineer',
                    'Durasi max 6 jam',
                    'Internet Dedicated 20 Mbps',
                    'Recording HD',
                ],
                'metadata'    => ['cameras' => 3, 'platforms' => 2, 'crew' => 3, 'max_hours' => 6],
                'is_featured' => true,
                'sort_order'  => 2,
            ],
            [
                'name'        => 'Paket Premium Streaming',
                'slug'        => 'multicam-premium',
                'price'       => 12000000,
                'description' => 'Solusi lengkap untuk konser, pernikahan mewah, dan event korporat skala besar.',
                'features'    => [
                    '5 Kamera Profesional + 1 Drone Cam',
                    'Live Switching Full HD',
                    'Output ke Semua Platform',
                    '3 Operator + 1 Director + 1 Audio Engineer',
                    'Durasi max 8 jam',
                    'Internet Dedicated 50 Mbps',
                    'Recording 4K',
                    'Lower Third & Grafis',
                    'Instant Replay',
                ],
                'metadata'    => ['cameras' => 6, 'platforms' => 'all', 'crew' => 5, 'max_hours' => 8],
                'is_featured' => false,
                'sort_order'  => 3,
            ],
        ];

        foreach ($multicamPackages as $pkg) {
            Package::updateOrCreate(
                ['slug' => $pkg['slug']],
                array_merge($pkg, ['service_id' => $multicam->id, 'is_active' => true])
            );
        }

        $multicamAddons = [
            ['name' => 'Kamera Tambahan', 'price' => 750000, 'unit' => 'unit/hari', 'sort_order' => 1],
            ['name' => 'Drone Camera', 'price' => 1500000, 'unit' => 'unit/hari', 'sort_order' => 2],
            ['name' => 'Tripod Profesional', 'price' => 150000, 'unit' => 'unit/hari', 'sort_order' => 3],
            ['name' => 'Video Switcher Tambahan', 'price' => 500000, 'unit' => 'unit/hari', 'sort_order' => 4],
            ['name' => 'Operator Tambahan', 'price' => 400000, 'unit' => 'orang/hari', 'sort_order' => 5],
            ['name' => 'Internet Dedicated Tambahan 10 Mbps', 'price' => 300000, 'unit' => 'paket/hari', 'sort_order' => 6],
            ['name' => 'Perpanjangan Durasi', 'price' => 500000, 'unit' => 'per jam', 'sort_order' => 7],
            ['name' => 'Teleprompter', 'price' => 350000, 'unit' => 'unit/hari', 'sort_order' => 8],
        ];

        foreach ($multicamAddons as $addon) {
            AddonItem::updateOrCreate(
                ['service_id' => $multicam->id, 'name' => $addon['name']],
                array_merge($addon, ['service_id' => $multicam->id, 'is_active' => true])
            );
        }

        // ─── 2. LED VIDEOTRON ──────────────────────────────────────────
        $videotron = Service::updateOrCreate(
            ['category' => ServiceCategory::Videotron->value],
            [
                'name'              => 'LED Videotron',
                'slug'              => 'led-videotron',
                'category'          => ServiceCategory::Videotron->value,
                'short_description' => 'Sewa LED Videotron berbagai ukuran untuk display visual yang memukau di indoor maupun outdoor.',
                'description'       => 'IFROSS MULTIMEDIA menyediakan layanan sewa LED Videotron dengan teknologi panel terkini. Kami melayani berbagai kebutuhan dari pameran, konser, pernikahan, hingga acara perusahaan. Sistem kalkulasi harga transparan berdasarkan ukuran layar yang Anda butuhkan.',
                'icon'              => 'tv',
                'hero_image'        => null,
                'is_active'         => true,
                'sort_order'        => 2,
            ]
        );

        // Videotron Specs
        $specs = [
            [
                'brand'                  => 'Nationstar',
                'model'                  => 'P3.91 Indoor',
                'power_consumption_watt' => 350,
                'brightness'             => 800,
                'panel_width_cm'         => 50,
                'panel_height_cm'        => 50,
                'price_per_m2'           => 1500000,
                'type'                   => 'indoor',
                'description'            => 'Panel indoor dengan konsumsi daya 350 W/m², ideal untuk event indoor.',
            ],
            [
                'brand'                  => 'Nationstar',
                'model'                  => 'P6 Outdoor',
                'power_consumption_watt' => 600,
                'brightness'             => 5000,
                'panel_width_cm'         => 96,
                'panel_height_cm'        => 96,
                'price_per_m2'           => 1800000,
                'type'                   => 'outdoor',
                'description'            => 'Panel outdoor dengan konsumsi daya 600 W/m² dan brightness tinggi 5000 nits.',
            ],
            [
                'brand'                  => 'Nationstar',
                'model'                  => 'P2.6 Indoor',
                'power_consumption_watt' => 450,
                'brightness'             => 600,
                'panel_width_cm'         => 50,
                'panel_height_cm'        => 50,
                'price_per_m2'           => 2000000,
                'type'                   => 'indoor',
                'description'            => 'Panel indoor fine pitch P2.6 dengan konsumsi daya 450 W/m².',
            ],
        ];

        foreach ($specs as $spec) {
            VideotronSpec::updateOrCreate(
                ['brand' => $spec['brand'], 'model' => $spec['model']],
                array_merge($spec, ['is_active' => true])
            );
        }

        // Videotron Packages (ukuran siap pakai)
        $videotronPackages = [
            [
                'name'        => 'Videotron 3×2 Meter',
                'slug'        => 'videotron-3x2',
                'price'       => 4500000,
                'description' => 'Ukuran compact 3m×2m = 6m², cocok untuk backdrop panggung kecil.',
                'features'    => ['Ukuran 3×2 Meter', 'LED P3.91 Indoor', 'Include Operator', 'Include Frame & Rigging', 'Include Materi Setting'],
                'metadata'    => ['width' => 3, 'height' => 2, 'area' => 6],
                'is_featured' => false,
                'sort_order'  => 1,
            ],
            [
                'name'        => 'Videotron 4×3 Meter',
                'slug'        => 'videotron-4x3',
                'price'       => 8000000,
                'description' => 'Ukuran medium 4m×3m = 12m², populer untuk pernikahan dan seminar.',
                'features'    => ['Ukuran 4×3 Meter', 'LED P3.91 Indoor', 'Include Operator', 'Include Frame & Rigging', 'Include Materi Setting', 'Include Technician'],
                'metadata'    => ['width' => 4, 'height' => 3, 'area' => 12],
                'is_featured' => true,
                'sort_order'  => 2,
            ],
            [
                'name'        => 'Videotron 6×4 Meter',
                'slug'        => 'videotron-6x4',
                'price'       => 16000000,
                'description' => 'Ukuran besar 6m×4m = 24m², ideal untuk konser dan event outdoor.',
                'features'    => ['Ukuran 6×4 Meter', 'LED P6 Outdoor', 'Include Operator', 'Include Struktur Rigging', 'Include Technician', 'Include Materi Setting', 'Include Level Rigging'],
                'metadata'    => ['width' => 6, 'height' => 4, 'area' => 24],
                'is_featured' => false,
                'sort_order'  => 3,
            ],
        ];

        foreach ($videotronPackages as $pkg) {
            Package::updateOrCreate(
                ['slug' => $pkg['slug']],
                array_merge($pkg, ['service_id' => $videotron->id, 'is_active' => true])
            );
        }

        $videotronAddons = [
            ['name' => 'Genset 10KVA', 'price' => 500000, 'unit' => 'unit/hari', 'sort_order' => 1],
            ['name' => 'Genset 20KVA', 'price' => 800000, 'unit' => 'unit/hari', 'sort_order' => 2],
            ['name' => 'Operator Tambahan', 'price' => 350000, 'unit' => 'orang/hari', 'sort_order' => 3],
            ['name' => 'Materi/Bumper Video Design', 'price' => 750000, 'unit' => 'paket', 'sort_order' => 4],
            ['name' => 'Level Rigging Tambahan', 'price' => 500000, 'unit' => 'unit', 'sort_order' => 5],
            ['name' => 'Perpanjangan Durasi', 'price' => 1000000, 'unit' => 'per hari', 'sort_order' => 6],
            ['name' => 'Transport & Pengiriman', 'price' => 300000, 'unit' => 'perjalanan', 'sort_order' => 7],
        ];

        foreach ($videotronAddons as $addon) {
            AddonItem::updateOrCreate(
                ['service_id' => $videotron->id, 'name' => $addon['name']],
                array_merge($addon, ['service_id' => $videotron->id, 'is_active' => true])
            );
        }

        // ─── 3. LIGHTING ──────────────────────────────────────────────
        $lighting = Service::updateOrCreate(
            ['category' => ServiceCategory::Lighting->value],
            [
                'name'              => 'Lighting & Tata Cahaya',
                'slug'              => 'lighting-tata-cahaya',
                'category'          => ServiceCategory::Lighting->value,
                'short_description' => 'Tata cahaya profesional untuk mempercantik panggung dan menciptakan atmosfer sempurna untuk event Anda.',
                'description'       => 'Layanan Lighting IFROSS MULTIMEDIA menggunakan peralatan tata cahaya profesional grade. Dari moving head, par LED, follow spot, hingga lighting controller DMX. Tim lighting artist kami berpengalaman dalam berbagai genre event mulai dari konser musik, pernikahan mewah, hingga acara korporat.',
                'icon'              => 'light-bulb',
                'hero_image'        => null,
                'is_active'         => true,
                'sort_order'        => 3,
            ]
        );

        $lightingPackages = [
            [
                'name'        => 'Paket Lighting Dasar',
                'slug'        => 'lighting-dasar',
                'price'       => 2500000,
                'description' => 'Cocok untuk acara kecil, ulang tahun, dan gathering indoor.',
                'features'    => [
                    '8 Par LED RGB',
                    '2 Moving Head Spot',
                    'DMX Controller',
                    '1 Lighting Operator',
                    'Durasi max 5 jam',
                ],
                'metadata'    => ['par_led' => 8, 'moving_head' => 2, 'crew' => 1, 'max_hours' => 5],
                'is_featured' => false,
                'sort_order'  => 1,
            ],
            [
                'name'        => 'Paket Lighting Standard',
                'slug'        => 'lighting-standard',
                'price'       => 5500000,
                'description' => 'Ideal untuk pernikahan, seminar besar, dan event indoor skala menengah.',
                'features'    => [
                    '16 Par LED RGB',
                    '4 Moving Head Spot + 2 Moving Head Wash',
                    'Haze Machine',
                    'DMX Controller Professional',
                    '2 Lighting Operator',
                    'Durasi max 8 jam',
                    'Lighting Design Consultation',
                ],
                'metadata'    => ['par_led' => 16, 'moving_head' => 6, 'crew' => 2, 'max_hours' => 8],
                'is_featured' => true,
                'sort_order'  => 2,
            ],
            [
                'name'        => 'Paket Lighting Premium',
                'slug'        => 'lighting-premium',
                'price'       => 12000000,
                'description' => 'Solusi tata cahaya lengkap untuk konser musik, gala dinner, dan event premium.',
                'features'    => [
                    '32 Par LED RGB',
                    '8 Moving Head Spot + 4 Moving Head Wash',
                    '2 Follow Spot',
                    'Haze Machine + Smoke Machine',
                    'Laser Show',
                    'DMX Controller Premium',
                    '3 Lighting Operator + 1 Lighting Director',
                    'Durasi max 10 jam',
                    'Full Lighting Design',
                ],
                'metadata'    => ['par_led' => 32, 'moving_head' => 12, 'follow_spot' => 2, 'crew' => 4, 'max_hours' => 10],
                'is_featured' => false,
                'sort_order'  => 3,
            ],
        ];

        foreach ($lightingPackages as $pkg) {
            Package::updateOrCreate(
                ['slug' => $pkg['slug']],
                array_merge($pkg, ['service_id' => $lighting->id, 'is_active' => true])
            );
        }

        $lightingAddons = [
            ['name' => 'Moving Head Spot Tambahan', 'price' => 300000, 'unit' => 'unit/hari', 'sort_order' => 1],
            ['name' => 'Moving Head Wash Tambahan', 'price' => 250000, 'unit' => 'unit/hari', 'sort_order' => 2],
            ['name' => 'Par LED RGB Tambahan', 'price' => 75000, 'unit' => 'unit/hari', 'sort_order' => 3],
            ['name' => 'Follow Spot', 'price' => 500000, 'unit' => 'unit/hari', 'sort_order' => 4],
            ['name' => 'Haze Machine', 'price' => 200000, 'unit' => 'unit/hari', 'sort_order' => 5],
            ['name' => 'Smoke Machine', 'price' => 150000, 'unit' => 'unit/hari', 'sort_order' => 6],
            ['name' => 'Laser Show', 'price' => 750000, 'unit' => 'paket/hari', 'sort_order' => 7],
            ['name' => 'Operator Tambahan', 'price' => 350000, 'unit' => 'orang/hari', 'sort_order' => 8],
            ['name' => 'Perpanjangan Durasi', 'price' => 500000, 'unit' => 'per jam', 'sort_order' => 9],
        ];

        foreach ($lightingAddons as $addon) {
            AddonItem::updateOrCreate(
                ['service_id' => $lighting->id, 'name' => $addon['name']],
                array_merge($addon, ['service_id' => $lighting->id, 'is_active' => true])
            );
        }
    }
}
