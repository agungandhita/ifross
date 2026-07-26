<x-layouts.auth title="Login Admin | IFROSS MULTIMEDIA">
    <h2 class="text-2xl font-bold font-sans text-text-dark text-center mb-2">Login Admin</h2>
    <p class="text-text-muted text-center mb-6">Masuk untuk mengelola sistem</p>

    <!-- Session Status -->
    @if(session('status'))
        <div class="mb-4 text-sm font-medium text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-text-dark mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-text-dark mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="rounded text-primary focus:ring-primary border-gray-300">
                <span class="text-sm text-text-muted">Ingat Saya</span>
            </label>
        </div>

        <button type="submit" class="btn-primary w-full mt-2">
            Masuk
        </button>
    </form>
</x-layouts.auth>
