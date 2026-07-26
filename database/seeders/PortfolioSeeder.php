<?php

namespace Database\Seeders;

use App\Enums\ServiceCategory;
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\Testimonial;
use App\Models\Site\Banner;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Banners ──────────────────────────────────────────────────
        $banners = [
            [
                'title'      => 'Wujudkan Event Terbaik Anda',
                'subtitle'   => 'Multicamera • LED Videotron • Lighting',
                'description' => 'IFROSS MULTIMEDIA hadir sebagai solusi lengkap kebutuhan multimedia event Anda di Lamongan dan sekitarnya.',
                'cta_text'   => 'Konsultasi Gratis',
                'cta_url'    => '/layanan',
                'badge_text' => '✦ Terpercaya Sejak 2018',
                'image'      => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=1600&q=80',
                'is_active'  => true,
                'sort_order' => 1,
            ],
            [
                'title'      => 'Live Streaming Profesional',
                'subtitle'   => 'Multi Kamera · Broadcast Quality',
                'description' => 'Siaran langsung event Anda ke jutaan penonton dengan kualitas broadcast televisi.',
                'cta_text'   => 'Lihat Paket Multicam',
                'cta_url'    => '/layanan#multicamera-live-streaming',
                'badge_text' => '🎬 Pro Broadcasting',
                'image'      => 'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?w=1600&q=80',
                'is_active'  => true,
                'sort_order' => 2,
            ],
            [
                'title'      => 'LED Videotron Spektakuler',
                'subtitle'   => 'Indoor & Outdoor · Berbagai Ukuran',
                'description' => 'Tampilkan visual memukau dengan panel LED terkini. Hitung estimasi harga secara real-time.',
                'cta_text'   => 'Hitung Estimasi Harga',
                'cta_url'    => '/layanan#led-videotron',
                'badge_text' => '🖥️ Full HD Display',
                'image'      => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80',
                'is_active'  => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(['title' => $banner['title']], $banner);
        }

        // ─── Portfolios & Testimonials ─────────────────────────────────
        $portfolios = [
            // Multicam
            [
                'title'       => 'Live Streaming Seminar Nasional Pendidikan 2024',
                'slug'        => 'live-streaming-seminar-nasional-pendidikan-2024',
                'category'    => ServiceCategory::Multicam->value,
                'description' => 'Live streaming seminar nasional dengan 4 kamera dan output ke YouTube & Zoom. Dihadiri 500+ peserta online dari seluruh Indonesia.',
                'location'    => 'Gedung Aula UNISDA Lamongan',
                'event_date'  => '2024-08-15',
                'client_name' => 'UNISDA Lamongan',
                'thumbnail'   => 'https://images.unsplash.com/photo-1559223607-a43c990c692c?w=800&q=80',
                'images'      => [
                    'https://images.unsplash.com/photo-1559223607-a43c990c692c?w=800&q=80',
                    'https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?w=800&q=80',
                ],
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
                'testimonial' => [
                    'name'     => 'Dr. Ahmad Fauzi, M.Pd',
                    'position' => 'Ketua Panitia — UNISDA Lamongan',
                    'rating'   => 5,
                    'review'   => 'IFROSS MULTIMEDIA sangat profesional! Streaming berjalan lancar tanpa gangguan selama 6 jam. Kualitas gambar dan suara sangat memuaskan. Pasti akan kami gunakan lagi untuk event berikutnya.',
                ],
            ],
            [
                'title'       => 'Live Streaming Pernikahan Budi & Sari',
                'slug'        => 'live-streaming-pernikahan-budi-sari',
                'category'    => ServiceCategory::Multicam->value,
                'description' => 'Dokumentasi dan live streaming pernikahan dengan 3 kamera. Momen bahagia disaksikan keluarga yang tidak bisa hadir secara langsung.',
                'location'    => 'Gedung Wedding CITRA Lamongan',
                'event_date'  => '2024-10-05',
                'client_name' => 'Keluarga Budi Santoso',
                'thumbnail'   => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&q=80',
                'images'      => [
                    'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&q=80',
                    'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&q=80',
                ],
                'is_featured' => false,
                'is_active'   => true,
                'sort_order'  => 2,
                'testimonial' => [
                    'name'     => 'Budi Santoso',
                    'position' => 'Client — Lamongan',
                    'rating'   => 5,
                    'review'   => 'Terima kasih IFROSS! Tim sangat ramah dan profesional. Streaming ke keluarga di luar kota berjalan sempurna. Gambarnya jernih dan suaranya jelas. Harga juga sangat terjangkau!',
                ],
            ],
            [
                'title'       => 'Live Streaming Pelantikan Pejabat Kabupaten Lamongan',
                'slug'        => 'live-streaming-pelantikan-pejabat-lamongan',
                'category'    => ServiceCategory::Multicam->value,
                'description' => 'Liputan dan live streaming resmi pelantikan pejabat dengan 5 kamera. Event disiarkan secara langsung ke media online daerah.',
                'location'    => 'Pendopo Kabupaten Lamongan',
                'event_date'  => '2024-12-01',
                'client_name' => 'Pemkab Lamongan',
                'thumbnail'   => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80',
                'images'      => ['https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80'],
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
                'testimonial' => [
                    'name'     => 'Humas Kabupaten Lamongan',
                    'position' => 'Klien Pemerintahan',
                    'rating'   => 5,
                    'review'   => 'Kualitas liputan sangat baik dan profesional. Tim datang tepat waktu dan setup sesuai rencana. Sangat merekomendasikan IFROSS untuk event-event pemerintahan.',
                ],
            ],

            // Videotron
            [
                'title'       => 'Videotron 6×4m Konser Musik Lamongan Fair',
                'slug'        => 'videotron-konser-lamongan-fair',
                'category'    => ServiceCategory::Videotron->value,
                'description' => 'Sewa LED Videotron outdoor 6×4 meter untuk panggung konser Lamongan Fair. Menampilkan visual spektakuler yang dilihat ribuan penonton.',
                'location'    => 'Alun-Alun Lamongan',
                'event_date'  => '2024-08-17',
                'client_name' => 'Dinas Pariwisata Lamongan',
                'thumbnail'   => 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?w=800&q=80',
                'images'      => [
                    'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?w=800&q=80',
                    'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=800&q=80',
                ],
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 4,
                'testimonial' => [
                    'name'     => 'Rizky Pratama',
                    'position' => 'Event Organizer — Lamongan Fair',
                    'rating'   => 5,
                    'review'   => 'Videotron dari IFROSS kualitasnya sangat bagus! Warna vivid dan brightness cukup bahkan untuk outdoor malam hari. Setup cepat dan tim teknisi sangat responsif. Recommended!',
                ],
            ],
            [
                'title'       => 'Videotron 4×3m Pameran Produk UMKM',
                'slug'        => 'videotron-pameran-umkm-lamongan',
                'category'    => ServiceCategory::Videotron->value,
                'description' => 'Videotron indoor 4×3 meter sebagai display utama pameran produk UMKM. Menampilkan video promosi dan informasi produk secara dinamis.',
                'location'    => 'Mall Grand Mercury Lamongan',
                'event_date'  => '2024-11-10',
                'client_name' => 'Dinas Koperasi & UMKM Lamongan',
                'thumbnail'   => 'https://images.unsplash.com/photo-1556742393-d75f468bfcb0?w=800&q=80',
                'images'      => ['https://images.unsplash.com/photo-1556742393-d75f468bfcb0?w=800&q=80'],
                'is_featured' => false,
                'is_active'   => true,
                'sort_order'  => 5,
                'testimonial' => [
                    'name'     => 'Siti Aminah',
                    'position' => 'Kepala Dinas UMKM Lamongan',
                    'rating'   => 5,
                    'review'   => 'Sangat membantu promosi produk UMKM kami. Visual yang ditampilkan menarik perhatian pengunjung. Harga sewa juga sangat kompetitif. Terima kasih IFROSS!',
                ],
            ],
            [
                'title'       => 'Backdrop Videotron Pernikahan Mewah',
                'slug'        => 'videotron-backdrop-pernikahan-mewah',
                'category'    => ServiceCategory::Videotron->value,
                'description' => 'Videotron indoor 3×2 meter sebagai backdrop utama pelaminan dengan tampilan foto pre-wedding animasi.',
                'location'    => 'Gedung Singgasana Wedding Hall',
                'event_date'  => '2025-01-20',
                'client_name' => 'Keluarga Wahyu Setiawan',
                'thumbnail'   => 'https://images.unsplash.com/photo-1478720568477-152d9b164e26?w=800&q=80',
                'images'      => ['https://images.unsplash.com/photo-1478720568477-152d9b164e26?w=800&q=80'],
                'is_featured' => false,
                'is_active'   => true,
                'sort_order'  => 6,
                'testimonial' => [
                    'name'     => 'Wahyu Setiawan',
                    'position' => 'Client — Gresik',
                    'rating'   => 5,
                    'review'   => 'Backdrop videotron bikin pernikahan kami jadi lebih berkesan! Foto pre-wedding kami tampak hidup dan elegan. Tamu undangan banyak yang kagum. Sangat worth it!',
                ],
            ],

            // Lighting
            [
                'title'       => 'Tata Cahaya Konser Band Indie Lamongan',
                'slug'        => 'lighting-konser-band-indie-lamongan',
                'category'    => ServiceCategory::Lighting->value,
                'description' => 'Full lighting setup untuk konser band indie. Moving head, par LED, dan laser show menciptakan atmosfer yang memukau.',
                'location'    => 'Gelora Jungblut Lamongan',
                'event_date'  => '2024-09-28',
                'client_name' => 'Sound Festival Lamongan',
                'thumbnail'   => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=800&q=80',
                'images'      => [
                    'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=800&q=80',
                    'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800&q=80',
                ],
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 7,
                'testimonial' => [
                    'name'     => 'Eko Prasetyo',
                    'position' => 'Produser — Sound Festival',
                    'rating'   => 5,
                    'review'   => 'Lighting dari IFROSS top abis! Moving head dan laser show bikin penonton histeris. Tim sangat kreatif dalam design lighting dan responsif saat ada permintaan mendadak. Salut!',
                ],
            ],
            [
                'title'       => 'Dekorasi Lighting Gala Dinner Korporat',
                'slug'        => 'lighting-gala-dinner-korporat',
                'category'    => ServiceCategory::Lighting->value,
                'description' => 'Tata cahaya elegan untuk gala dinner tahunan perusahaan. Kombinasi pin spot, par LED, dan backdrop lighting menciptakan suasana premium.',
                'location'    => 'Hotel Mahkota Lamongan',
                'event_date'  => '2024-12-20',
                'client_name' => 'PT. Surya Nusa Lamongan',
                'thumbnail'   => 'https://images.unsplash.com/photo-1545558014-8692077e9b5c?w=800&q=80',
                'images'      => ['https://images.unsplash.com/photo-1545558014-8692077e9b5c?w=800&q=80'],
                'is_featured' => false,
                'is_active'   => true,
                'sort_order'  => 8,
                'testimonial' => [
                    'name'     => 'Direktur HR — PT Surya Nusa',
                    'position' => 'Klien Korporat',
                    'rating'   => 5,
                    'review'   => 'Lighting untuk gala dinner kami sangat memuaskan. Suasana jadi premium dan elegan. Karyawan kami sangat terkesan. Tim IFROSS sangat profesional dan tepat waktu.',
                ],
            ],
            [
                'title'       => 'Stage Lighting Wisuda UNISDA 2025',
                'slug'        => 'lighting-wisuda-unisda-2025',
                'category'    => ServiceCategory::Lighting->value,
                'description' => 'Tata cahaya lengkap untuk acara wisuda universitas. Follow spot untuk graduasi, backdrop LED, dan ambient lighting untuk seluruh aula.',
                'location'    => 'Gedung Serbaguna UNISDA Lamongan',
                'event_date'  => '2025-02-15',
                'client_name' => 'UNISDA Lamongan',
                'thumbnail'   => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=800&q=80',
                'images'      => ['https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=800&q=80'],
                'is_featured' => false,
                'is_active'   => true,
                'sort_order'  => 9,
                'testimonial' => [
                    'name'     => 'Panitia Wisuda UNISDA',
                    'position' => 'Universitas — Lamongan',
                    'rating'   => 5,
                    'review'   => 'Sudah 3 tahun berturut-turut kami menggunakan IFROSS untuk wisuda. Selalu memuaskan! Kualitas konsisten dan tim sangat berpengalaman menangani event universitas besar.',
                ],
            ],
        ];

        foreach ($portfolios as $portfolioData) {
            $testimonialData = $portfolioData['testimonial'];
            unset($portfolioData['testimonial']);

            $portfolio = Portfolio::updateOrCreate(
                ['slug' => $portfolioData['slug']],
                $portfolioData
            );

            Testimonial::updateOrCreate(
                ['portfolio_id' => $portfolio->id, 'name' => $testimonialData['name']],
                array_merge($testimonialData, [
                    'portfolio_id' => $portfolio->id,
                    'is_active'    => true,
                    'sort_order'   => 0,
                ])
            );
        }
    }
}
