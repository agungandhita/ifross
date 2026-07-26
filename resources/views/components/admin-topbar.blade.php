<!-- Topbar -->
<header class="sticky top-0 z-30 bg-white shadow-sm h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8 shrink-0">
    
    <!-- Mobile menu button -->
    <button @click="sidebarOpen = true" class="text-gray-500 hover:text-primary lg:hidden transition-colors">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Page Title / Breadcrumb (can be dynamic) -->
    <div class="hidden lg:flex items-center">
        <h1 class="text-lg font-bold text-gray-900">{{ $title ?? 'Dashboard' }}</h1>
    </div>

    <!-- Right side (Profile dropdown) -->
    <div class="flex items-center ml-auto" x-data="{ dropdownOpen: false }">
        <div class="relative">
            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-2.5 text-gray-500 hover:text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 rounded-full p-1 transition-all">
                <div class="w-9 h-9 rounded-full bg-primary-light text-primary-dark flex items-center justify-center font-bold text-sm border border-primary/20 shadow-sm">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <span class="hidden md:block text-sm font-semibold text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                <svg class="w-4 h-4 hidden md:block text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            
            <!-- Dropdown -->
            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                 class="origin-top-right absolute right-0 mt-3 w-56 rounded-xl shadow-xl bg-white border border-gray-100 divide-y divide-gray-100 z-50">
                <div class="px-5 py-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Masuk sebagai</p>
                    <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->email ?? 'admin@ifross.com' }}</p>
                </div>
                <div class="py-1">
                    <a href="{{ route('profile.edit') ?? '#' }}" class="flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Profil
                    </a>
                </div>
                <div class="py-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 w-full text-left px-5 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors rounded-b-xl">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>