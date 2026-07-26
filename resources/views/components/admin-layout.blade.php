<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Panel Admin IFROSS MULTIMEDIA — kelola layanan, paket, portofolio, dan pengaturan situs.">

    <title>{{ $title ?? 'Admin Panel' }} — IFROSS MULTIMEDIA Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600|plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

    <!-- Scripts / Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-body antialiased bg-gray-50 text-gray-900 overflow-hidden" x-data="{ sidebarOpen: false }">
    
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <x-admin-sidebar />

        <!-- Main Content -->
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
            
            <!-- Topbar -->
            <x-admin-topbar />

            <!-- Content Area -->
            <main>
                <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
                    {{ $slot }}
                </div>
            </main>

        </div>
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('swal:success', (data) => {
                const payload = Array.isArray(data) ? data[0] : data;
                Swal.fire({
                    icon: 'success',
                    title: payload.title,
                    text: payload.text,
                    showConfirmButton: false,
                    timer: 2000
                });
            });

            Livewire.on('swal:confirm', (data) => {
                const payload = Array.isArray(data) ? data[0] : data;
                Swal.fire({
                    title: payload.title,
                    text: payload.text,
                    icon: payload.type,
                    showCancelButton: true,
                    confirmButtonColor: '#1D4ED8',
                    cancelButtonColor: '#EF4444',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch(payload.action, { id: payload.id });
                    }
                });
            });
        });
    </script>
</body>
</html>