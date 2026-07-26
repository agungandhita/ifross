<!-- Sidebar backdrop -->
<div x-show="sidebarOpen" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-40 lg:hidden" @click="sidebarOpen = false" x-cloak
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"></div>

<!-- Sidebar -->
<div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-100 shadow-sm transition-transform duration-300 ease-in-out lg:translate-x-0 flex flex-col h-screen">
    
    <!-- Logo -->
    <div class="h-16 flex items-center justify-center border-b border-gray-100 shrink-0">
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center justify-center w-full h-full pt-1">
            <img src="{{ asset('image/ifross-multimedia.png') }}" alt="Logo" class="h-8 w-auto max-w-[180px] object-contain">
            <span class="font-bold font-sans text-[9px] tracking-[0.3em] text-primary-dark uppercase mt-1 leading-none">Admin</span>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1 custom-scrollbar">
        
        <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 mt-2">Utama</p>
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-primary-dark' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Dashboard
        </a>
        
        <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-500 hover:bg-gray-50 hover:text-primary-dark transition-all duration-200">
            <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            Lihat Website
        </a>

        <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 mt-8">Katalog</p>
        <a href="{{ route('admin.packages.index') ?? '#' }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.packages.*') ? 'bg-primary/10 text-primary shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-primary-dark' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.packages.*') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            Paket Layanan
        </a>
        <a href="{{ route('admin.addons.index') ?? '#' }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.addons.*') ? 'bg-primary/10 text-primary shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-primary-dark' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.addons.*') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Item Tambahan
        </a>
        <a href="{{ route('admin.videotron.index') ?? '#' }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.videotron.*') ? 'bg-primary/10 text-primary shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-primary-dark' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.videotron.*') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            Spek Videotron
        </a>
        <a href="{{ route('admin.promos.index') ?? '#' }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.promos.*') ? 'bg-primary/10 text-primary shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-primary-dark' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.promos.*') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            Promo
        </a>

        <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 mt-8">Konten</p>
        <a href="{{ route('admin.portfolios.index') ?? '#' }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.portfolios.*') ? 'bg-primary/10 text-primary shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-primary-dark' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.portfolios.*') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Portofolio
        </a>
        <a href="{{ route('admin.testimonials.index') ?? '#' }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.testimonials.*') ? 'bg-primary/10 text-primary shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-primary-dark' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.testimonials.*') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
            Testimoni
        </a>
        <a href="{{ route('admin.banners.index') ?? '#' }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.banners.*') ? 'bg-primary/10 text-primary shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-primary-dark' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.banners.*') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
            Banners (Hero)
        </a>

        <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 mt-8">Sistem</p>
        <a href="{{ route('admin.settings.index') ?? '#' }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.settings.*') ? 'bg-primary/10 text-primary shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-primary-dark' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.settings.*') ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            Pengaturan Situs
        </a>
    </nav>
</div>