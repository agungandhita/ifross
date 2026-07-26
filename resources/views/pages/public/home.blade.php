<x-layouts.public title="Beranda | {{ App\Models\Site\SiteSetting::get('meta_title', 'IFROSS MULTIMEDIA') }}">
    
    <!-- Hero Banner Carousel -->
    <section class="relative bg-gray-900 h-[600px] sm:h-[700px] overflow-hidden">
        @if($banners->count() > 0)
            <div x-data="{ activeSlide: 0, slides: {{ $banners->count() }}, timer: null }"
                 x-init="timer = setInterval(() => { activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1 }, 5000)"
                 class="relative h-full w-full">
                 
                @foreach($banners as $index => $banner)
                    <div x-show="activeSlide === {{ $index }}" 
                         x-transition.opacity.duration.1000ms
                         class="absolute inset-0 h-full w-full"
                         style="display: none;">
                         
                        <div class="absolute inset-0">
                            <img src="{{ $banner->image }}" alt="{{ $banner->title }}" class="w-full h-full object-cover" />
                            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 to-gray-900/40"></div>
                        </div>

                        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
                            <div class="max-w-2xl text-white animate-fade-in-up">
                                @if($banner->badge_text)
                                    <span class="badge-primary mb-4 bg-primary text-white border-none">{{ $banner->badge_text }}</span>
                                @endif
                                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold font-sans tracking-tight mb-4">
                                    {{ $banner->title }}
                                </h1>
                                @if($banner->subtitle)
                                    <h2 class="text-xl sm:text-2xl text-gray-300 font-medium mb-4">
                                        {{ $banner->subtitle }}
                                    </h2>
                                @endif
                                @if($banner->description)
                                    <p class="text-lg text-gray-400 mb-8 max-w-xl">
                                        {{ $banner->description }}
                                    </p>
                                @endif
                                @if($banner->cta_text && $banner->cta_url)
                                    <a href="{{ url($banner->cta_url) }}" class="btn-primary text-lg px-8 py-4">
                                        {{ $banner->cta_text }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <!-- Controls -->
                <div class="absolute bottom-6 left-0 right-0 flex justify-center gap-2">
                    @foreach($banners as $index => $banner)
                        <button @click="activeSlide = {{ $index }}; clearInterval(timer); timer = setInterval(() => { activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1 }, 5000)"
                                class="w-3 h-3 rounded-full transition-colors duration-300"
                                :class="activeSlide === {{ $index }} ? 'bg-primary' : 'bg-white/50 hover:bg-white'">
                        </button>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Fallback if no banner -->
            <div class="absolute inset-0 bg-gradient-to-r from-primary-dark to-primary"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
                <div class="max-w-2xl text-white">
                    <h1 class="text-4xl sm:text-6xl font-bold font-sans mb-4">IFROSS MULTIMEDIA</h1>
                    <p class="text-xl mb-8">Solusi lengkap kebutuhan multimedia event Anda.</p>
                </div>
            </div>
        @endif
    </section>

    <!-- Services Overview -->
    <section class="py-20 section-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-header">
                <span class="text-primary font-bold tracking-wider uppercase text-sm">Layanan Kami</span>
                <h2 class="mt-2">Pilih Layanan Sesuai Kebutuhan Anda</h2>
                <p>Kami menyediakan solusi multimedia profesional untuk mendukung kesuksesan event Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="card-service group">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center bg-{{ $service->category->color() }}/10 text-{{ $service->category->color() }} mb-4 transition-transform group-hover:scale-110">
                            @if($service->icon === 'video-camera')
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            @elseif($service->icon === 'tv')
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            @else
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold group-hover:text-{{ $service->category->color() }} transition-colors">
                            {{ $service->name }}
                        </h3>
                        <p class="text-text-muted flex-grow">
                            {{ $service->short_description }}
                        </p>
                        <a href="{{ route('layanan.index') }}#{{ $service->slug }}" class="text-{{ $service->category->color() }} font-semibold mt-4 inline-flex items-center gap-1 hover:gap-2 transition-all">
                            Lihat Detail 
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-20 section-gray">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="text-primary font-bold tracking-wider uppercase text-sm">Keunggulan Kami</span>
                    <h2 class="text-3xl md:text-4xl font-bold mt-2 mb-6 text-text-dark">Kenapa Memilih IFROSS MULTIMEDIA?</h2>
                    
                    <div class="space-y-8">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-text-dark mb-1">Berpengalaman Sejak 2018</h4>
                                <p class="text-text-muted">Telah menangani ratusan event dari skala kecil hingga nasional dengan tingkat kepuasan tinggi.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-text-dark mb-1">Peralatan Terkini & Profesional</h4>
                                <p class="text-text-muted">Menggunakan standar alat broadcast dan multimedia terkini untuk memastikan hasil yang maksimal dan bebas kendala.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-text-dark mb-1">Harga Transparan</h4>
                                <p class="text-text-muted">Sistem perhitungan harga yang jelas dan fitur kalkulator harga online untuk memudahkan budgeting event Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="absolute inset-0 bg-primary/20 rounded-2xl transform translate-x-4 translate-y-4"></div>
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80" alt="Crew IFROSS" class="relative z-10 rounded-2xl shadow-xl w-full h-auto object-cover aspect-[4/3]">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Portfolios -->
    @if($featuredPortfolios->count() > 0)
    <section class="py-20 section-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div class="max-w-2xl">
                    <span class="text-primary font-bold tracking-wider uppercase text-sm">Portofolio</span>
                    <h2 class="text-3xl md:text-4xl font-bold mt-2 text-text-dark">Karya & Event Terbaru</h2>
                </div>
                <a href="{{ route('portofolio.index') }}" class="btn-outline mt-6 md:mt-0">Lihat Semua</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredPortfolios as $portfolio)
                    <div class="card group">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $portfolio->first_image }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute top-4 left-4">
                                <span class="badge-primary shadow-sm">{{ $portfolio->category->shortLabel() }}</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-text-muted mb-3">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $portfolio->event_date?->format('d M Y') ?? 'Ongoing' }}
                                <span class="mx-1">•</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="truncate">{{ $portfolio->location }}</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('portofolio.show', $portfolio->slug) }}">
                                    {{ $portfolio->title }}
                                </a>
                            </h3>
                            <p class="text-text-muted text-sm line-clamp-3 mb-4">
                                {{ $portfolio->description }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</x-layouts.public>
