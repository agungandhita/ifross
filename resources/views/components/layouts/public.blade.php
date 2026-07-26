<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? App\Models\Site\SiteSetting::get('meta_title', 'IFROSS MULTIMEDIA') }}</title>
    <meta name="description" content="{{ $description ?? App\Models\Site\SiteSetting::get('meta_description', '') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600|plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

    <!-- Scripts / Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-50 flex flex-col font-body antialiased selection:bg-primary selection:text-white">

    <!-- Navbar -->
    <x-public.navbar />

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-public.footer />

    <!-- Floating WhatsApp Button -->
    <x-public.floating-wa />

    @livewireScripts
    @include('sweetalert::alert')
</body>
</html>
