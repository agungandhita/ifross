<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Login | IFROSS MULTIMEDIA' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600|plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

    <!-- Scripts / Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 font-body antialiased selection:bg-primary selection:text-white flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block">
                <span class="text-3xl font-bold font-sans text-primary">IFROSS<br><span class="text-text-dark">MULTIMEDIA</span></span>
            </a>
        </div>

        <!-- Card -->
        <div class="card p-8">
            {{ $slot }}
        </div>
        
        <div class="text-center mt-8 text-sm text-text-muted">
            &copy; {{ date('Y') }} IFROSS MULTIMEDIA. All rights reserved.
        </div>
    </div>

</body>
</html>
