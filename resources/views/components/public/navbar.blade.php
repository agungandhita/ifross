<nav x-data="{ open: false }" class="bg-primary-dark text-white sticky top-0 z-40 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('image/ifross-multimedia.png') }}" alt="IFROSS MULTIMEDIA" class="h-8 w-auto bg-white p-1 rounded">
                    <span class="font-sans font-bold text-lg tracking-wide hidden sm:block">IFROSS MULTIMEDIA</span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center">
                <div class="ml-10 flex items-baseline space-x-8">
                    <a href="{{ route('home') }}" class="hover:text-primary-light px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-white border-b-2 border-primary-light' : 'text-gray-300' }}">Beranda</a>
                    <a href="{{ route('layanan.index') }}" class="hover:text-primary-light px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('layanan.*') ? 'text-white border-b-2 border-primary-light' : 'text-gray-300' }}">Layanan</a>
                    <a href="{{ route('portofolio.index') }}" class="hover:text-primary-light px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('portofolio.*') ? 'text-white border-b-2 border-primary-light' : 'text-gray-300' }}">Portofolio</a>
                </div>
                <div class="ml-8 border-l border-primary-light/30 pl-8">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-primary-dark bg-white hover:bg-gray-50 transition-colors">
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-4 py-2 border border-primary-light rounded-lg text-sm font-medium text-white hover:bg-primary-light hover:text-primary-dark transition-colors">
                            Login
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex md:hidden">
                <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-primary-dark focus:ring-white">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed -->
                    <svg x-show="!open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open -->
                    <svg x-show="open" x-cloak class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-cloak class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-primary">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'bg-primary-dark text-white' : 'text-gray-200 hover:bg-primary-dark hover:text-white' }}">Beranda</a>
            <a href="{{ route('layanan.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('layanan.*') ? 'bg-primary-dark text-white' : 'text-gray-200 hover:bg-primary-dark hover:text-white' }}">Layanan</a>
            <a href="{{ route('portofolio.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('portofolio.*') ? 'bg-primary-dark text-white' : 'text-gray-200 hover:bg-primary-dark hover:text-white' }}">Portofolio</a>
            <div class="pt-4 pb-2 border-t border-primary-light/30 mt-2">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="block w-full text-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-base font-medium text-primary-dark bg-white hover:bg-gray-50 transition-colors">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 border border-primary-light rounded-lg text-base font-medium text-white hover:bg-primary-light hover:text-primary-dark transition-colors">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
