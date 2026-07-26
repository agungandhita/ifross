---
trigger: always_on
---

# AGENTS.md — IFROSS MULTIMEDIA Website

## Role
Kamu adalah full-stack developer expert Laravel + Livewire + TailwindCSS,
membangun company profile & booking website untuk penyedia jasa event
(Multicamera Live Streaming, LED Videotron, Lighting).

## Project Goal
Calon customer bisa melihat detail layanan, menghitung estimasi harga
(paket siap pakai atau custom), lalu diarahkan ke WhatsApp dengan pesan
yang sudah terisi otomatis (nama layanan, item yang dipilih, total harga).

## Tech Stack (WAJIB, jangan ganti)
- Laravel (versi stable terbaru)
- Livewire 3 — untuk semua interaksi reaktif (kalkulator harga, filter
  portofolio, custom booking form, tabel admin)
- TailwindCSS — styling, mobile-first
- MySQL/PostgreSQL
- Laravel Breeze (auth admin, session-based) — TIDAK memakai Filament
  atau library admin panel pihak ketiga apa pun. Admin panel dibangun
  custom dari Blade + Livewire.
- Pest PHP — testing

## Critical Rules
1. JANGAN install/gunakan Filament, Nova, Backpack, atau admin panel
   generator pihak ketiga apa pun. Semua CRUD admin dibuat manual
   dengan Livewire component.
2. Semua business logic perhitungan harga WAJIB ada di Service class
   terpisah (bukan di dalam Livewire component langsung).
3. Gunakan DTO untuk transfer data antara Livewire component dan Service.
4. Gunakan PHP 8.1+ Enum untuk kategori tetap: ServiceCategory
   (MULTICAM, VIDEOTRON, LIGHTING) dan BookingType (PACKAGE, CUSTOM).
5. UUID sebagai primary key di semua tabel utama.
6. FormRequest wajib untuk validasi input di semua form admin.
7. Livewire component kalkulator harga harus reaktif (wire:model.live),
   tidak boleh reload halaman.
8. Setiap perhitungan harga & resolusi WAJIB punya unit test Pest.
9. Jangan hardcode nomor WhatsApp, template pesan, atau harga apa pun
   di kode — semua harus bisa diedit dari admin panel (tabel site_settings).

## Design System — Palet Warna (WAJIB dipakai konsisten)
Tema: Biru & Putih. Definisikan sebagai Tailwind custom color di `tailwind.config.js`,
JANGAN pakai warna hardcode/random di luar palet ini.

```js
colors: {
  primary: {
    DEFAULT: '#1D4ED8', // Blue 700 - tombol utama, navbar, link aktif
    dark: '#1E3A8A',    // Blue 900 - hover state, footer
    light: '#DBEAFE',   // Blue 100 - background section alternatif, badge
  },
  accent: '#0EA5E9',    // Sky 500 - highlight kalkulator, step indikator
  base: {
    white: '#FFFFFF',
    gray: '#F8FAFC',    // Slate 50 - background section selingan
  },
  text: {
    dark: '#1E293B',    // Slate 800 - judul/body
    muted: '#64748B',   // Slate 500 - teks sekunder
  },
  success: '#22C55E',   // tombol WhatsApp (hijau khas WA, dipertahankan)
}
```

Aturan penerapan:
- Navbar & footer: `primary-dark`, teks putih
- Hero: `primary` (solid atau gradient ke putih), teks putih
- Card (package/portofolio): background `base-white`, border tipis abu, aksen `primary` di judul/harga
- Tombol aksi utama (pilih paket, hitung custom): `primary`, hover `primary-dark`
- Tombol "Pesan via WhatsApp": tetap `success` (hijau), bukan biru — supaya tetap instan dikenali user sebagai WhatsApp
- Section berselang-seling background: `base-white` → `base-gray` → `base-white`
- Jangan gunakan warna selain token di atas kecuali untuk status non-UI utama (error state boleh pakai red-500 standar Tailwind)

## Data Model (garis besar)
- services (kategori: multicam / videotron / lighting)
- packages (belongs to service; nama, harga, deskripsi, gambar, metadata JSON)
- addon_items (belongs to service; nama, harga satuan, satuan/unit)
- videotron_specs (pixel_pitch, brightness, panel_size — untuk kalkulasi resolusi)
- portfolios (kategori, judul, deskripsi, media, tanggal event)
- testimonials (nama, foto, rating, review, relasi opsional ke portfolio)
- banners (untuk hero beranda)
- site_settings (nomor WA tujuan, template pesan WA, harga genset default, dll)
- admin_users (auth admin — Laravel Breeze default)

## Core Features to Build

### 1. Halaman Publik
- Beranda: hero, ringkasan 3 layanan, USP section, highlight klien,
  testimoni carousel, floating WA button
- Portofolio: grid dengan filter kategori (Livewire), detail modal/halaman,
  testimoni terkait
- Layanan (index): 3 card kategori + panduan booking + FAQ
- Detail Layanan per kategori (Multicam / Videotron / Lighting):
  - Toggle: "Paket Ready" vs "Custom"
  - Mode Paket: list package cards → pilih → ringkasan + tombol WA
  - Mode Custom:
    - Multicam: pilih paket dasar + checkbox/qty addon → live price calc
    - Videotron: input ukuran (lebar x tinggi meter) → hitung estimasi
      harga & resolusi otomatis + pilih addon (genset, bumper, level rigging)
    - Lighting: pilih paket dasar + checkbox/qty addon → live price calc
  - Order summary sebelum ke WhatsApp
  - Tombol "Pesan via WhatsApp" generate URL wa.me dengan pesan terformat

### 2. PricingService (business logic, class terpisah)
- calculatePackagePrice(Package $package, array $addons): Money
- calculateCustomVideotronPrice(float $width, float $height, VideotronSpec $spec, array $addons): Money
- calculateResolution(float $width, float $height, VideotronSpec $spec): ResolutionDTO

### 3. WhatsappMessageBuilderService
- buildMessage(BookingSummaryDTO $summary): string
- generateWhatsappUrl(string $phoneNumber, string $message): string

### 4. Admin Panel (Custom Livewire — TANPA Filament)
- Auth: Laravel Breeze, route prefix /admin, middleware auth
- Layout admin: sidebar navigasi + topbar, Blade component
- Livewire CRUD table (search, sort, pagination native Livewire) untuk:
  Package, AddonItem, VideotronSpec, Portfolio, Testimonial, Banner
- Halaman Settings untuk site_settings (nomor WA, template pesan, dll)
- Semua form pakai FormRequest + validasi Livewire real-time

## Non-Functional Requirements
- Mobile-first responsive (Tailwind breakpoints)
- SEO: meta title/description dinamis per halaman layanan & portofolio, sitemap.xml
- Performance: lazy load gambar, cache query package & addon
- Aksesibilitas: kontras warna cukup, alt text pada gambar

## Deliverables yang diharapkan dari Agent
1. Migration & model untuk semua tabel di atas (UUID PK)
2. Enum & DTO classes
3. PricingService + WhatsappMessageBuilderService + unit test Pest
4. Livewire components untuk semua halaman publik di atas
5. Blade views TailwindCSS (mobile-first)
6. Admin panel custom (Breeze auth + Livewire CRUD, tanpa library pihak ketiga)
7. Seeder contoh data (dummy package, addon, portofolio) untuk demo