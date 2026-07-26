<div>
    <!-- Filter Navigation -->
    <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-4 mb-12">
        <button wire:click="setCategory('all')" 
                class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-sm
                {{ $category === 'all' ? 'bg-primary text-white scale-105' : 'bg-white text-gray-600 border border-gray-200 hover:border-primary hover:text-primary' }}">
            Semua
        </button>
        
        @foreach($categories as $cat)
            <button wire:click="setCategory('{{ $cat->value }}')" 
                    class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-sm
                    {{ $category === $cat->value ? 'bg-'.$cat->color().' text-white scale-105' : 'bg-white text-gray-600 border border-gray-200 hover:border-'.$cat->color().' hover:text-'.$cat->color() }}">
                {{ $cat->shortLabel() }}
            </button>
        @endforeach
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($portfolios as $portfolio)
            <a href="{{ route('portofolio.show', $portfolio->slug) }}" 
               class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between" 
               wire:key="portfolio-{{ $portfolio->id }}">
                <div>
                    <div class="relative h-56 overflow-hidden bg-gray-900">
                        <img src="{{ $portfolio->first_image }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute top-4 left-4 flex items-center gap-2">
                            <span class="px-3 py-1 rounded-full text-xs font-bold shadow-sm bg-primary text-white">{{ $portfolio->category->shortLabel() }}</span>
                        </div>
                        @if(count($portfolio->image_urls) > 1)
                            <div class="absolute bottom-3 right-3 bg-black/60 backdrop-blur-xs text-white text-[11px] font-bold px-2.5 py-1 rounded-md flex items-center gap-1 shadow-sm">
                                📷 {{ count($portfolio->image_urls) }} Foto
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 text-xs text-gray-500 font-medium mb-3">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $portfolio->event_date?->format('d M Y') ?? 'Liputan' }}
                            </span>
                            @if($portfolio->location)
                                <span class="flex items-center gap-1 truncate">
                                    <svg class="w-4 h-4 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="truncate">{{ $portfolio->location }}</span>
                                </span>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                            {{ $portfolio->title }}
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-3 leading-relaxed mb-4">
                            {{ $portfolio->description }}
                        </p>
                    </div>
                </div>
                
                <div class="px-6 pb-6 pt-0 flex items-center text-primary font-bold text-sm group-hover:translate-x-1 transition-transform">
                    <span>Baca Liputan Event</span>
                    <svg class="w-4 h-4 ml-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>
        @empty
            <div class="col-span-full py-16 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <h3 class="text-xl font-bold text-gray-700">Tidak ada portofolio</h3>
                <p class="text-gray-500 mt-2">Belum ada portofolio untuk kategori ini.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($portfolios->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $portfolios->links() }}
        </div>
    @endif
</div>dif
</div>
