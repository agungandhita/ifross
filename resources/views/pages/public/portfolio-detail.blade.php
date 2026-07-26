<x-layouts.public :title="$portfolio->title . ' | Liputan Event IFROSS MULTIMEDIA'">

    <!-- Hero Section (Light Theme to contrast with Navbar) -->
    <div class="relative pt-12 pb-16 lg:pt-20 lg:pb-24 overflow-hidden bg-base-white border-b border-slate-200/60">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03]"></div>
        <div class="absolute -top-32 -right-32 w-[30rem] h-[30rem] bg-primary-light rounded-full blur-[100px] opacity-40 pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-[25rem] h-[25rem] bg-accent/20 rounded-full blur-[80px] opacity-30 pointer-events-none"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center justify-center gap-2 text-sm text-text-muted font-medium mb-8">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
                <span class="opacity-40">/</span>
                <a href="{{ route('portofolio.index') }}" class="hover:text-primary transition-colors">Portofolio</a>
                <span class="opacity-40">/</span>
                <span class="text-text-dark font-semibold truncate max-w-[200px] sm:max-w-xs">{{ $portfolio->title }}</span>
            </nav>

            <!-- Category Badges -->
            <div class="flex flex-wrap items-center justify-center gap-3 mb-6">
                <span class="px-4 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase bg-primary-light/50 text-primary border border-primary/10">
                    {{ $portfolio->category->shortLabel() }}
                </span>
                <span class="px-4 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase bg-slate-100 text-slate-600 border border-slate-200/60">
                    Liputan Event Dokumentasi
                </span>
            </div>

            <!-- Headline Title -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight text-text-dark mb-10 drop-shadow-sm">
                {{ $portfolio->title }}
            </h1>

            <!-- Metadata Bar -->
            <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-text-dark font-medium">
                @if($portfolio->event_date)
                    <div class="flex items-center gap-2 bg-base-white px-4 py-2.5 rounded-2xl border border-slate-200/60 shadow-sm">
                        <svg class="w-5 h-5 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>{{ $portfolio->event_date->format('d F Y') }}</span>
                    </div>
                @endif

                @if($portfolio->location)
                    <div class="flex items-center gap-2 bg-base-white px-4 py-2.5 rounded-2xl border border-slate-200/60 shadow-sm">
                        <svg class="w-5 h-5 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="max-w-[200px] truncate">{{ $portfolio->location }}</span>
                    </div>
                @endif

                @if($portfolio->client_name)
                    <div class="flex items-center gap-2 bg-base-white px-4 py-2.5 rounded-2xl border border-slate-200/60 shadow-sm">
                        <svg class="w-5 h-5 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0v-4m0 4h4m-4-4l-4 4m4-4l4 4"></path></svg>
                        <span>Klien: <strong class="text-text-dark font-extrabold">{{ $portfolio->client_name }}</strong></span>
                    </div>
                @endif
                
                @if(is_array($portfolio->image_urls) || is_countable($portfolio->image_urls))
                    <div class="flex items-center gap-2 bg-base-white px-4 py-2.5 rounded-2xl border border-slate-200/60 shadow-sm">
                        <svg class="w-5 h-5 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span><strong class="text-text-dark font-extrabold">{{ count($portfolio->image_urls) }}</strong> Foto HD</span>
                    </div>
                @endif
            </div>
            
            <!-- Back Button -->
            <div class="mt-12 flex justify-center">
                <a href="{{ route('portofolio.index') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold transition-all group shadow-sm border border-slate-200/60">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Kembali ke Portofolio Utama</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="bg-base-gray py-12 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12 items-start">
                
                <!-- Left Content Column -->
                <div class="lg:col-span-2 space-y-10">
                    
                    <!-- Alpine.js Photo Gallery Carousel -->
                    @php
                        $photos = $portfolio->image_urls;
                    @endphp

                    @if(!empty($photos))
                        <div x-data="{ activeIndex: 0 }" class="bg-base-white rounded-3xl p-4 sm:p-6 shadow-sm border border-slate-200/60">
                            
                            <!-- Main Image Display -->
                            <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden bg-slate-900 shadow-inner group">
                                @foreach($photos as $idx => $photoUrl)
                                    <div x-show="activeIndex === {{ $idx }}" 
                                         x-transition:enter="transition ease-out duration-500"
                                         x-transition:enter-start="opacity-0 scale-105"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         class="absolute inset-0 w-full h-full"
                                         style="display: none;">
                                        <img src="{{ $photoUrl }}" alt="{{ $portfolio->title }} - Foto {{ $idx + 1 }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach

                                @if(is_array($photos) && count($photos) > 1)
                                    <!-- Counter Badge -->
                                    <div class="absolute top-4 right-4 bg-black/50 backdrop-blur-md text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-lg border border-white/10 transition-opacity">
                                        <span x-text="activeIndex + 1"></span> / {{ count($photos) }}
                                    </div>

                                    <!-- Navigation Arrows -->
                                    <button @click="activeIndex = (activeIndex === 0) ? {{ count($photos) - 1 }} : activeIndex - 1"
                                            aria-label="Previous Photo"
                                            class="absolute left-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-black/40 hover:bg-black/70 text-white transition-all backdrop-blur-md border border-white/10 shadow-xl lg:opacity-0 lg:group-hover:opacity-100 focus:opacity-100 outline-none">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                                    </button>
                                    <button @click="activeIndex = (activeIndex === {{ count($photos) - 1 }}) ? 0 : activeIndex + 1"
                                            aria-label="Next Photo"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-black/40 hover:bg-black/70 text-white transition-all backdrop-blur-md border border-white/10 shadow-xl lg:opacity-0 lg:group-hover:opacity-100 focus:opacity-100 outline-none">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                    </button>
                                @endif
                            </div>

                            <!-- Thumbnail Strip -->
                            @if(is_array($photos) && count($photos) > 1)
                                <div class="mt-6">
                                    <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-transparent">
                                        @foreach($photos as $idx => $photoUrl)
                                            <button @click="activeIndex = {{ $idx }}"
                                                    :class="{ 'ring-2 ring-primary ring-offset-2 opacity-100': activeIndex === {{ $idx }}, 'opacity-60 hover:opacity-100 grayscale-[30%] hover:grayscale-0': activeIndex !== {{ $idx }} }"
                                                    class="relative w-24 h-16 sm:w-28 sm:h-20 rounded-xl overflow-hidden shrink-0 transition-all duration-300 cursor-pointer bg-slate-100 focus:outline-none">
                                                <img src="{{ $photoUrl }}" alt="Thumbnail {{ $idx + 1 }}" class="w-full h-full object-cover">
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Video Card -->
                    @if($portfolio->video_url)
                        <div class="bg-base-white rounded-3xl p-6 sm:p-8 border border-slate-200/60 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6 group hover:border-primary/30 transition-colors">
                            <div class="flex items-center gap-5 w-full">
                                <div class="w-14 h-14 rounded-2xl bg-primary-light/50 flex items-center justify-center text-primary shrink-0 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-300 shadow-inner">
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-extrabold text-text-dark text-lg mb-1">Tayangan Video Live Event</h4>
                                    <p class="text-sm text-text-muted">Tonton rekaman langsung dengan kualitas tinggi dari acara ini.</p>
                                </div>
                            </div>
                            <a href="{{ $portfolio->video_url }}" target="_blank" rel="noopener noreferrer" 
                               class="w-full sm:w-auto shrink-0 px-6 py-3 bg-primary hover:bg-primary-dark text-white rounded-xl font-bold text-sm shadow-md hover:shadow-lg transition-all text-center flex items-center justify-center gap-2">
                                <span>Putar Video</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        </div>
                    @endif

                    <!-- Story & Description -->
                    <div class="bg-base-white rounded-3xl p-6 sm:p-10 border border-slate-200/60 shadow-sm">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-100 pb-6 mb-6 gap-2">
                            <h3 class="text-2xl font-extrabold text-text-dark tracking-tight">Detail Pelaksanaan</h3>
                            <span class="inline-block bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider">Laporan Tim</span>
                        </div>
                        
                        <div class="prose prose-slate prose-blue max-w-none text-text-dark leading-loose text-base whitespace-pre-line">
                            {{ $portfolio->description }}
                        </div>
                    </div>

                    <!-- Testimonials -->
                    @if($portfolio->testimonials && $portfolio->testimonials->isNotEmpty())
                        <div class="bg-primary-light/30 rounded-3xl p-6 sm:p-10 border border-primary-light shadow-sm">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 rounded-2xl bg-primary text-white flex items-center justify-center text-xl font-bold shadow-md">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-text-dark text-xl">Testimoni Klien</h4>
                                    <p class="text-sm text-text-muted mt-1">Ulasan langsung dari penyelenggara acara</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($portfolio->testimonials as $t)
                                    <div class="bg-base-white rounded-2xl p-6 border border-slate-200 shadow-sm relative">
                                        <!-- Quote Icon -->
                                        <div class="absolute top-4 right-4 text-slate-100">
                                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"></path></svg>
                                        </div>
                                        <div class="relative z-10 space-y-4">
                                            <div class="flex items-center text-amber-400 text-sm gap-1">
                                                @for($i = 0; $i < ($t->rating ?? 5); $i++) 
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                @endfor
                                            </div>
                                            <p class="text-slate-600 text-sm sm:text-base italic leading-relaxed">"{{ $t->review }}"</p>
                                            <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-primary-light flex items-center justify-center text-primary font-bold text-lg">
                                                    {{ substr($t->name, 0, 1) }}
                                                </div>
                                                <div class="font-bold text-text-dark text-sm">{{ $t->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Right Sidebar Column (Sticky) -->
                <div class="lg:col-span-1 space-y-6 lg:sticky lg:top-28">
                    
                    <!-- Event Summary Card -->
                    <div class="bg-base-white rounded-3xl p-6 sm:p-8 border border-slate-200/60 shadow-sm">
                        <h4 class="font-extrabold text-text-dark text-lg pb-4 border-b border-slate-100 flex items-center gap-3 mb-4">
                            <div class="bg-primary-light/50 p-2 rounded-lg text-primary">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            Ringkasan Event
                        </h4>

                        <div class="space-y-4 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-text-muted font-medium">Kategori Jasa</span>
                                <span class="font-bold text-primary bg-primary-light/40 px-3 py-1 rounded-lg text-xs">{{ $portfolio->category->shortLabel() }}</span>
                            </div>

                            @if($portfolio->client_name)
                                <div class="flex items-start justify-between gap-4">
                                    <span class="text-text-muted font-medium shrink-0">Mitra / Klien</span>
                                    <span class="font-bold text-text-dark text-right">{{ $portfolio->client_name }}</span>
                                </div>
                            @endif

                            @if($portfolio->event_date)
                                <div class="flex items-center justify-between">
                                    <span class="text-text-muted font-medium">Tanggal</span>
                                    <span class="font-bold text-text-dark">{{ $portfolio->event_date->format('d F Y') }}</span>
                                </div>
                            @endif

                            @if($portfolio->location)
                                <div class="flex items-start justify-between gap-4">
                                    <span class="text-text-muted font-medium shrink-0">Lokasi</span>
                                    <span class="font-bold text-text-dark text-right truncate" title="{{ $portfolio->location }}">{{ $portfolio->location }}</span>
                                </div>
                            @endif

                            <div class="flex items-center justify-between pt-4 border-t border-slate-100 mt-2">
                                <span class="text-text-muted font-medium">Status</span>
                                <span class="font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-lg text-xs flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Selesai
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Direct WhatsApp Booking CTA Card -->
                    @php
                        $waNumber = \App\Models\Site\SiteSetting::get('whatsapp_number', '6281259956419');
                        $waMsg = urlencode("Halo IFROSS MULTIMEDIA, saya melihat liputan portofolio \"{$portfolio->title}\" dan tertarik konsultasi jasa serupa untuk event saya.");
                        $waUrl = "https://wa.me/{$waNumber}?text={$waMsg}";
                    @endphp

                    <div class="bg-primary bg-gradient-to-br from-primary to-primary-dark rounded-3xl p-6 sm:p-8 shadow-xl shadow-primary/20 relative overflow-hidden text-white border border-primary-dark">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        </div>
                        
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 text-white text-xs font-bold backdrop-blur-md border border-white/20 mb-5 shadow-sm">
                            <span class="animate-pulse">💬</span> Konsultasi Gratis
                        </div>

                        <h4 class="text-2xl font-extrabold text-white leading-tight mb-4">
                            Ingin Event Anda Sukses Seperti Ini?
                        </h4>

                        <p class="text-sm text-blue-100 leading-relaxed font-medium mb-8">
                            Tim profesional kami siap membantu kebutuhan Multicam Live Streaming, LED Videotron, dan Lighting untuk segala skala event Anda.
                        </p>

                        <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" 
                           class="relative w-full py-4 px-6 bg-success hover:bg-[#1da851] text-white rounded-2xl font-bold text-base shadow-lg shadow-green-900/40 transition-all flex items-center justify-center gap-3 group overflow-hidden border border-green-400/30">
                            <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out"></div>
                            <svg class="w-6 h-6 group-hover:scale-110 transition-transform relative z-10" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            <span class="relative z-10">Pesan via WhatsApp</span>
                        </a>
                    </div>

                    <!-- Key Guarantees Badges Card -->
                    <div class="bg-base-white rounded-3xl p-6 border border-slate-200/60 shadow-sm space-y-5">
                        <div class="flex items-center gap-4 text-sm font-semibold text-text-dark">
                            <span class="w-10 h-10 rounded-2xl bg-primary-light/60 text-primary flex items-center justify-center text-lg shadow-inner shrink-0">⚡</span>
                            <span>Peralatan & Crew Profesional</span>
                        </div>
                        <div class="flex items-center gap-4 text-sm font-semibold text-text-dark">
                            <span class="w-10 h-10 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-lg shadow-inner shrink-0">🎥</span>
                            <span>Visual Full HD Multi-Angle</span>
                        </div>
                        <div class="flex items-center gap-4 text-sm font-semibold text-text-dark">
                            <span class="w-10 h-10 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg shadow-inner shrink-0">🛠️</span>
                            <span>Dukungan Tim Teknis di Lokasi</span>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Related Portfolios Bottom Section -->
            @if($relatedPortfolios->isNotEmpty())
                <div class="mt-24 border-t border-slate-200/60 pt-16">
                    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
                        <div>
                            <span class="text-xs font-bold text-accent uppercase tracking-widest flex items-center gap-2 mb-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                Dokumentasi Lainnya
                            </span>
                            <h3 class="text-3xl font-extrabold text-text-dark">Liputan Event Terkait</h3>
                        </div>
                        <a href="{{ route('portofolio.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-primary hover:text-primary-dark transition-colors bg-primary-light/30 px-5 py-2.5 rounded-xl hover:bg-primary-light/60">
                            Lihat Semua Portofolio 
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($relatedPortfolios as $item)
                            <a href="{{ route('portofolio.show', $item->slug) }}" 
                               class="bg-base-white rounded-3xl border border-slate-200/60 overflow-hidden shadow-sm hover:shadow-xl hover:border-primary/30 hover:-translate-y-2 transition-all duration-300 group flex flex-col h-full">
                                <div class="relative h-56 overflow-hidden bg-slate-900">
                                    <img src="{{ $item->first_image }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out opacity-90 group-hover:opacity-100">
                                    <div class="absolute top-4 left-4">
                                        <span class="px-3 py-1.5 rounded-xl text-xs font-bold bg-white/90 backdrop-blur-md text-text-dark shadow-md">{{ $item->category->shortLabel() }}</span>
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center gap-2 text-xs text-text-muted mb-3 font-semibold">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $item->event_date?->format('d M Y') ?? 'Liputan' }} 
                                            <span class="text-slate-300">•</span> 
                                            <span class="truncate max-w-[120px]">{{ $item->location }}</span>
                                        </div>
                                        <h4 class="font-extrabold text-text-dark text-lg line-clamp-2 group-hover:text-primary transition-colors leading-snug mb-4">
                                            {{ $item->title }}
                                        </h4>
                                    </div>
                                    <div class="text-sm font-bold text-primary flex items-center gap-2 mt-auto">
                                        <span>Baca Liputan</span>
                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-layouts.public>
