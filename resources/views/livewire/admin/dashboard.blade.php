<div class="space-y-8">
    <!-- Welcome banner -->
    <div class="bg-gradient-to-r from-primary-dark via-primary to-accent rounded-2xl shadow-lg p-8 text-white relative overflow-hidden">
        <!-- Decorative circles -->
        <div class="absolute top-0 right-0 -mr-8 -mt-8 w-64 h-64 rounded-full bg-white opacity-10 blur-2xl"></div>
        <div class="absolute bottom-0 right-32 -mb-10 w-40 h-40 rounded-full bg-white opacity-10 blur-xl"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-bold mb-2">Selamat datang, {{ Auth::user()->name }}! 👋</h2>
                <p class="text-primary-light text-base max-w-2xl">
                    Ini adalah pusat kontrol Anda. Kelola semua layanan, paket, portofolio, dan testimoni IFROSS MULTIMEDIA dari satu panel yang mudah digunakan.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center justify-center px-5 py-2.5 bg-white text-primary-dark font-medium text-sm rounded-lg hover:bg-gray-50 transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    Lihat Website
                </a>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            Akses Cepat
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.packages.index') }}" class="group flex flex-col items-center p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md hover:border-primary/30 transition-all">
                <div class="w-12 h-12 bg-primary/10 text-primary rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-primary">Kelola Paket</span>
            </a>
            <a href="{{ route('admin.portfolios.index') }}" class="group flex flex-col items-center p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md hover:border-primary/30 transition-all">
                <div class="w-12 h-12 bg-accent/10 text-accent rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-accent">Upload Portofolio</span>
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="group flex flex-col items-center p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md hover:border-primary/30 transition-all">
                <div class="w-12 h-12 bg-green-500/10 text-green-600 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-green-600">Testimoni Klien</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="group flex flex-col items-center p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md hover:border-primary/30 transition-all">
                <div class="w-12 h-12 bg-gray-500/10 text-gray-600 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">Setting Website</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Stats Column -->
        <div class="lg:col-span-1 space-y-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
                <svg class="w-5 h-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Ringkasan Data
            </h3>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Layanan Utama</p>
                    <h4 class="text-2xl font-bold text-gray-900">{{ $stats->totalServices }}</h4>
                </div>
                <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Paket Layanan</p>
                    <h4 class="text-2xl font-bold text-gray-900">{{ $stats->totalPackages }}</h4>
                </div>
                <div class="w-12 h-12 bg-indigo-50 text-indigo-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Portofolio</p>
                    <h4 class="text-2xl font-bold text-gray-900">{{ $stats->totalPortfolios }}</h4>
                </div>
                <div class="w-12 h-12 bg-sky-50 text-sky-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Testimoni Klien</p>
                    <h4 class="text-2xl font-bold text-gray-900">{{ $stats->totalTestimonials }}</h4>
                </div>
                <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Item Tambahan (Addon)</p>
                    <h4 class="text-2xl font-bold text-gray-900">{{ $stats->totalAddons }}</h4>
                </div>
                <div class="w-12 h-12 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Recent Portfolios Table -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden h-full flex flex-col">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Portofolio Terbaru</h3>
                    <a href="{{ route('admin.portfolios.index') }}" class="text-sm font-medium text-primary hover:text-primary-dark transition-colors">Lihat Semua &rarr;</a>
                </div>
                <div class="flex-1 overflow-x-auto">
                    @if($recentPortfolios->count() > 0)
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50">
                                    <th class="py-3 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul & Klien</th>
                                    <th class="py-3 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="py-3 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal Event</th>
                                    <th class="py-3 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($recentPortfolios as $portfolio)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                @php $thumbUrl = $portfolio->thumbnail ?? ($portfolio->images[0] ?? null); @endphp
                                                @if($thumbUrl)
                                                    <img src="{{ $thumbUrl }}" alt="{{ $portfolio->title }}" class="w-10 h-10 rounded-md object-cover">
                                                @else
                                                    <div class="w-10 h-10 rounded-md bg-gray-100 flex items-center justify-center text-gray-400">
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">{{ Str::limit($portfolio->title, 30) }}</p>
                                                    <p class="text-xs text-gray-500">{{ $portfolio->client_name ?? 'Tidak ada klien' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($portfolio->category)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $portfolio->category->badgeClasses() }}">
                                                    {{ $portfolio->category->shortLabel() }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-xs">—</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-600">
                                            {{ $portfolio->event_date ? $portfolio->event_date->format('d M Y') : '-' }}
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            @if($portfolio->is_active)
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-gray-100 text-gray-500 rounded-full text-xs font-medium">
                                                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>Draft
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-8 text-center flex flex-col items-center justify-center h-full">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            <p class="text-sm font-medium text-gray-500">Belum ada data portofolio</p>
                            <a href="{{ route('admin.portfolios.index') }}" class="mt-3 text-sm text-primary hover:underline">Tambah Sekarang</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
