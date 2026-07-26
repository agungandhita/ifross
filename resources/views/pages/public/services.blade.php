<x-layouts.public title="Layanan Kami | {{ App\Models\Site\SiteSetting::get('meta_title', 'IFROSS MULTIMEDIA') }}">
    
    <!-- Header -->
    <section class="bg-primary-dark py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4">Layanan Kami</h1>
            <p class="text-primary-light max-w-2xl mx-auto text-lg">Pilih layanan multimedia yang sesuai dengan kebutuhan event Anda, mulai dari Multicam, Videotron, hingga Lighting profesional.</p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-12 section-gray">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div x-data="{ activeService: window.location.hash ? window.location.hash.replace('#', '') : '{{ $services->first()?->slug }}' }"
                 x-init="
                    const checkHash = () => {
                        const hash = window.location.hash.replace('#', '');
                        if (hash && document.getElementById('tab-' + hash)) {
                            activeService = hash;
                        }
                    };
                    checkHash();
                    window.addEventListener('hashchange', checkHash);
                 "
                 class="flex flex-col md:flex-row gap-8">
                
                <!-- Sidebar Nav -->
                <div class="w-full md:w-64 flex-shrink-0">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 sticky top-24">
                        <h3 class="font-bold text-gray-900 mb-4 px-3">Kategori Layanan</h3>
                        <nav class="space-y-1">
                            @foreach($services as $service)
                                @php
                                    $hasServicePromo = $service->packages->contains(fn($p) => $p->activePromo && $p->activePromo->isCurrentlyActive());
                                @endphp
                                <button id="tab-{{ $service->slug }}"
                                        @click="activeService = '{{ $service->slug }}'; window.location.hash = '{{ $service->slug }}'"
                                        class="w-full text-left px-3.5 py-3 rounded-xl font-medium transition-all duration-200 flex items-center justify-between gap-2"
                                        :class="activeService === '{{ $service->slug }}' ? 'bg-primary/10 text-primary font-bold shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'">
                                    <span class="text-sm font-semibold truncate">{{ $service->name }}</span>
                                    <div class="flex items-center gap-1.5 shrink-0">
                                        @if($hasServicePromo)
                                            <span class="bg-red-500 text-white text-[9px] font-black px-1.5 py-0.5 rounded-md uppercase tracking-wider">PROMO</span>
                                        @endif
                                        <svg x-show="activeService === '{{ $service->slug }}'" class="w-4 h-4 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </div>
                                </button>
                            @endforeach
                        </nav>
                    </div>
                </div>
                
                <!-- Main Service Content -->
                <div class="flex-grow w-full md:w-3/4">
                    @foreach($services as $service)
                        <div x-show="activeService === '{{ $service->slug }}'" x-cloak class="animate-fade-in-up">
                            
                            <!-- Service Info -->
                            <div class="mb-8">
                                <h2 class="text-3xl font-bold text-gray-900 mb-3">{{ $service->name }}</h2>
                                <p class="text-gray-600 max-w-3xl leading-relaxed text-lg">{{ $service->description }}</p>
                                <div class="mt-6 border-b border-gray-200"></div>
                            </div>
                            
                            <!-- Livewire Booking Component -->
                            <livewire:public.service-booking :service="$service" :wire:key="'booking-'.$service->id" />
                            
                        </div>
                    @endforeach
                </div>
                
            </div>
            
        </div>
    </section>

</x-layouts.public>
