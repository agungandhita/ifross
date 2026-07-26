1. Problem Statement
Saat ini IFROSS MULTIMEDIA (penyedia jasa Multicamera Live Streaming, LED Videotron, dan Lighting) belum memiliki media digital resmi yang menampilkan katalog layanan, portofolio, dan skema harga secara terbuka. Proses penawaran dan pemesanan masih sepenuhnya bergantung pada komunikasi manual satu per satu melalui WhatsApp/telepon, tanpa referensi visual atau daftar harga yang bisa diakses calon customer secara mandiri.
Kondisi ini menimbulkan beberapa masalah nyata:
•	Calon customer tidak punya gambaran harga awal sebelum menghubungi admin, sehingga banyak chat berhenti di tahap tanya-tanya tanpa lanjut ke closing.
•	Admin/tim sales harus menjelaskan ulang spesifikasi paket, harga, dan item tambahan secara manual di setiap chat masuk — proses berulang yang memakan waktu dan rawan informasi tidak konsisten antar calon customer.
•	Portofolio dan testimoni event yang pernah ditangani tidak terdokumentasi di satu tempat yang mudah diakses, sehingga sulit membangun kepercayaan calon customer baru.
•	Permintaan layanan custom (ukuran LED Videotron non-standar, kombinasi item tambahan) tidak punya alat bantu hitung, sehingga estimasi harga rawan salah atau lambat diberikan.
•	Tidak ada kanalisasi yang jelas dari “tertarik” ke “booking” — calon customer harus mencari sendiri kontak yang tepat untuk dihubungi.
Website katalog & booking ini dibangun untuk menutup gap tersebut: memberi calon customer akses mandiri ke informasi produk, harga, dan portofolio, sekaligus menyederhanakan proses lanjut ke transaksi melalui WhatsApp dengan detail pesanan yang sudah terstruktur.

2. Goals
2.1 Business Goals
•	Meningkatkan jumlah leads booking yang masuk ke WhatsApp dengan detail pesanan yang sudah jelas (paket/custom + estimasi harga), sehingga mempercepat proses closing.
•	Membangun kredibilitas dan brand awareness IFROSS MULTIMEDIA melalui katalog portofolio dan testimoni yang terdokumentasi rapi.
•	Mengurangi beban repetitif tim admin dalam menjawab pertanyaan seputar harga dan spesifikasi paket dasar.
•	Menyediakan kanal digital yang bisa dikembangkan untuk kebutuhan SEO dan pemasaran jangka panjang (branding Iffros Multimedia).
2.2 Product Goals
•	Calon customer dapat melihat seluruh layanan (Multicamera Live Streaming, LED Videotron, Lighting) beserta paket dan harga tanpa harus bertanya ke admin terlebih dahulu.
•	Calon customer dapat menghitung estimasi harga secara mandiri, baik untuk paket siap pakai maupun kebutuhan custom (termasuk estimasi resolusi untuk LED Videotron).
•	Proses dari “lihat layanan” ke “hubungi admin” terjadi dalam satu alur singkat, dengan pesan WhatsApp yang sudah otomatis terisi rincian pesanan.
•	Tim internal (owner/admin) dapat mengelola seluruh konten (paket, harga, portofolio, testimoni) secara mandiri melalui admin panel, tanpa perlu bantuan developer untuk setiap perubahan kecil.

3. Target Users
Persona	Deskripsi	Kebutuhan Utama
Event Organizer / Wedding Organizer	EO yang rutin membutuhkan mitra multicam, videotron, atau lighting untuk acara klien mereka.	Perbandingan paket cepat, harga transparan, bisa langsung kontak untuk beberapa event sekaligus.
Panitia Sekolah / Kampus / Instansi Pemerintah	Panitia acara wisuda, perpisahan, seminar, atau acara seremonial instansi yang biasanya nonteknis.	Penjelasan paket yang mudah dipahami orang awam, contoh dokumentasi event sejenis, estimasi harga awal untuk pengajuan anggaran.
Perusahaan / Corporate	PIC marketing/HR yang mengurus acara internal (gathering, product launch, town hall) dan butuh live streaming multi-platform.	Spesifikasi teknis jelas (jumlah kamera, output platform), portofolio event korporat, respons cepat.
Individu (Pernikahan, Ulang Tahun, Acara Pribadi)	Calon pengantin atau keluarga yang mencari jasa dekorasi visual (videotron/lighting) atau live streaming untuk kerabat jauh.	Tampilan visual paket menarik, harga per ukuran/paket jelas, proses booking simpel lewat HP.
Admin / Owner IFROSS MULTIMEDIA (internal)	Pengelola konten & operasional bisnis yang menerima leads dari website.	Kemudahan update paket/harga/portofolio tanpa coding, kontrol penuh atas nomor WA dan template pesan.

4. User Stories
4.1 Epic: Menjelajah Katalog Layanan
ID	User Story	Prioritas
US-01	Sebagai calon customer, saya ingin melihat ringkasan 3 layanan utama di halaman Beranda, agar saya langsung tahu apa saja yang ditawarkan IFROSS MULTIMEDIA.	Must
US-02	Sebagai calon customer, saya ingin membaca alasan/USP kenapa harus memilih IFROSS MULTIMEDIA, agar saya lebih yakin sebelum menghubungi admin.	Should
US-03	Sebagai calon customer, saya ingin melihat galeri portofolio event yang pernah ditangani beserta testimoninya, agar saya percaya dengan kualitas layanan.	Must
US-04	Sebagai calon customer, saya ingin memfilter portofolio berdasarkan kategori layanan (Multicam/Videotron/Lighting), agar saya cepat menemukan contoh yang relevan dengan kebutuhan saya.	Should
4.2 Epic: Pemesanan Paket Ready
ID	User Story	Prioritas
US-05	Sebagai calon customer, saya ingin melihat daftar bundling package tiap layanan beserta harga dan spesifikasinya, agar saya bisa membandingkan pilihan.	Must
US-06	Sebagai calon customer, saya ingin menambahkan item tambahan (addon) ke paket yang saya pilih dan melihat total harga terupdate otomatis, agar saya tahu estimasi biaya akhir sebelum menghubungi admin.	Must
US-07	Sebagai calon customer, saya ingin klik tombol “Pesan via WhatsApp” yang otomatis membuka chat berisi rincian paket, addon, dan total harga, agar saya tidak perlu mengetik ulang detail pesanan.	Must
4.3 Epic: Pemesanan Custom
ID	User Story	Prioritas
US-08	Sebagai calon customer, saya ingin memilih mode “Custom” pada halaman layanan, agar saya bisa menyesuaikan pesanan sesuai kebutuhan spesifik saya.	Must
US-09	Sebagai calon customer yang butuh LED Videotron ukuran khusus, saya ingin memasukkan ukuran lebar x tinggi dan langsung melihat estimasi harga serta estimasi resolusi, agar saya tahu kelayakan visual sebelum booking.	Must
US-10	Sebagai calon customer, saya ingin melihat ringkasan pesanan custom (item, qty, harga) sebelum diarahkan ke WhatsApp, agar saya bisa mengecek ulang sebelum mengirim permintaan.	
4.4 Epic: Pengelolaan Konten (Admin)
ID	User Story	Prioritas
US-11	Sebagai admin, saya ingin login ke halaman admin secara aman, agar hanya saya/tim yang berwenang yang bisa mengubah data.	Must
US-12	Sebagai admin, saya ingin menambah/mengubah/menghapus paket, harga, dan item tambahan untuk tiap kategori layanan, agar informasi di website selalu update tanpa perlu bantuan developer.	Must
US-13	Sebagai admin, saya ingin mengunggah portofolio (foto/video) dan testimoni baru, agar katalog bukti kerja terus bertambah seiring event yang ditangani.	Must
US-14	Sebagai admin, saya ingin mengatur nomor WhatsApp tujuan dan template pesan dari satu halaman pengaturan, agar saya bisa mengganti kontak tanpa mengubah kode.	

5. Functional Requirements
5.1 Halaman Publik — Umum
FR ID	Deskripsi Kebutuhan
FR-01	Sistem harus menampilkan Beranda berisi hero section, ringkasan 3 layanan, section USP, highlight klien, dan carousel testimoni.
FR-02	Sistem harus menampilkan tombol WhatsApp mengambang (floating) di seluruh halaman publik.
FR-03	Sistem harus menampilkan halaman Portofolio dengan filter kategori layanan dan detail tiap item portofolio (media, deskripsi, testimoni terkait).
FR-04	Sistem harus menampilkan halaman Layanan Produk berisi 3 kategori layanan, panduan cara booking, dan FAQ.
5.2 Multicamera Live Streaming
FR ID	Deskripsi Kebutuhan
FR-05	Sistem harus menampilkan daftar bundling package (nama, harga, jumlah kamera, output platform, crew, durasi).
FR-06	Sistem harus menampilkan daftar item tambahan beserta harga satuan (tripod, drone cam, switcher, operator tambahan, dll).
FR-07	Sistem harus menghitung total harga secara reaktif saat user memilih package dasar dan/atau item tambahan, tanpa reload halaman.
FR-08	Sistem harus menyediakan tombol pesan yang menghasilkan link WhatsApp berisi rincian package, item tambahan, dan total harga.
5.3 LED Videotron
FR ID	Deskripsi Kebutuhan
FR-09	Sistem harus menampilkan deskripsi produk (merk, pixel pitch, brightness, tipe panel) untuk tiap varian LED Videotron.
FR-10	Sistem harus menampilkan daftar bundling package berdasarkan ukuran, lengkap dengan harga dan contoh gambar.
FR-11	Sistem harus menyediakan mode Custom: user memasukkan ukuran lebar x tinggi, sistem menghitung estimasi harga secara otomatis.
FR-12	Sistem harus menghitung estimasi resolusi tampilan berdasarkan pixel pitch dan ukuran layar yang dipilih/diinput.
FR-13	Sistem harus menampilkan item tambahan (genset, operator tambahan, materi/bumper video, level rigging) dengan harga satuan yang bisa ditambahkan ke perhitungan total.
FR-14	Sistem harus menyediakan tombol pesan yang menghasilkan link WhatsApp berisi ukuran, resolusi estimasi, item tambahan, dan total harga.
5.4 Lighting
FR ID	Deskripsi Kebutuhan
FR-15	Sistem harus menampilkan daftar bundling package (nama, harga, contoh gambar, daftar item dalam paket).
FR-16	Sistem harus menampilkan daftar item tambahan per unit (moving head, par led, dll) dengan harga satuan.
FR-17	Sistem harus menghitung total harga secara reaktif dari package + item tambahan yang dipilih.
FR-18	Sistem harus menyediakan tombol pesan yang menghasilkan link WhatsApp berisi rincian package, item tambahan, dan total harga.
5.5 Alur Pemesanan
FR ID	Deskripsi Kebutuhan
FR-19	Sistem harus menampilkan ringkasan pesanan (order summary) sebelum user diarahkan ke WhatsApp, baik untuk alur paket maupun custom.
FR-20	Sistem harus meng-generate URL WhatsApp (wa.me) dengan pesan yang sudah terisi otomatis: nama layanan, rincian item/ukuran, dan total harga.
FR-21	Nomor WhatsApp tujuan dan template pesan harus dapat diubah melalui admin panel, tidak hardcode di kode program.
5.6 Admin Panel (Custom — tanpa Filament)
FR ID	Deskripsi Kebutuhan
FR-22	Sistem harus menyediakan autentikasi admin (login/logout) dengan proteksi middleware pada seluruh route /admin.
FR-23	Sistem harus menyediakan CRUD untuk Package, Addon Item, Videotron Spec, Portofolio, Testimoni, dan Banner.
FR-24	Sistem harus menyediakan tabel data admin dengan fitur pencarian, pengurutan, dan pagination.
FR-25	Sistem harus menyediakan halaman Pengaturan Umum untuk mengubah nomor WhatsApp, template pesan, dan harga default (mis. genset).
FR-26	Sistem harus memvalidasi seluruh input form admin (mis. harga tidak boleh negatif, field wajib tidak boleh kosong) sebelum data disimpan.

6. Non-Functional Requirements
Kategori	Kebutuhan
Responsiveness	Seluruh halaman publik dan admin harus tampil optimal secara mobile-first, mengingat mayoritas calon customer mengakses dari HP.
Performance	Halaman dengan gambar portofolio/paket harus menerapkan lazy loading; data paket dan addon yang jarang berubah harus di-cache untuk mempercepat waktu muat.
SEO	Setiap halaman layanan dan portofolio harus memiliki meta title/description dinamis, slug URL yang bersih, dan sitemap.xml.
Usability	Alur dari melihat layanan sampai ke tombol WhatsApp harus dapat diselesaikan tanpa reload halaman (interaksi reaktif via Livewire).
Security	Route admin harus terlindungi middleware autentikasi; seluruh input form admin divalidasi lewat FormRequest untuk mencegah data tidak valid/berbahaya.
Maintainability	Business logic perhitungan harga & resolusi harus berada di Service class terpisah (bukan di Livewire component) dan dilengkapi unit test (Pest), agar mudah diuji dan diubah ke depannya.
Konsistensi Visual	Seluruh komponen UI harus mengikuti palet warna biru & putih yang telah ditetapkan (lihat Design System), tanpa warna di luar token yang disepakati.
Kemudahan Pengelolaan Konten	Seluruh harga, paket, dan konten media harus dapat diubah oleh admin non-teknis melalui admin panel custom, tanpa perlu mengubah kode program.
Skalabilitas	Struktur data (kategori, paket, addon) harus mendukung penambahan layanan baru atau item tambahan baru di kemudian hari tanpa perubahan struktur inti.

7. Scope
7.1 In-Scope (Fase 1)
•	Halaman publik: Beranda, Portofolio, Layanan Produk (index + detail 3 kategori: Multicam, Videotron, Lighting).
•	Kalkulator harga reaktif untuk paket ready dan mode custom (termasuk kalkulator estimasi resolusi LED Videotron).
•	Integrasi tombol pesan ke WhatsApp dengan pesan otomatis terisi rincian pesanan.
•	Admin panel custom (autentikasi + CRUD Package, Addon, Videotron Spec, Portofolio, Testimoni, Banner, Pengaturan Umum).
•	Penerapan design system warna biru & putih secara konsisten di seluruh halaman.
•	Optimasi dasar SEO (meta tag dinamis, sitemap) dan tampilan mobile-first.
7.2 Out-of-Scope (Fase 1 — dipertimbangkan untuk fase berikutnya)
•	Sistem pembayaran online / payment gateway (transaksi tetap dilanjutkan manual via WhatsApp).
•	Sistem booking dengan kalender ketersediaan tanggal (availability calendar) secara real-time.
•	Akun/login untuk customer (riwayat pemesanan, tracking status).
•	Live chat bawaan website (di luar redirect ke WhatsApp).
•	Integrasi otomatis dengan CRM atau sistem invoice.
•	Aplikasi mobile native (Android/iOS) — fase 1 hanya web responsive.
•	Multi-bahasa (website fase 1 hanya Bahasa Indonesia).
