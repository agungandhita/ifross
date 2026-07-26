<div>
    <!-- Header Actions -->
    <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
            <!-- Search Bar -->
            <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl border border-gray-200 bg-white shadow-2xs focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all w-full sm:w-72">
                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari promo..." class="w-full bg-transparent text-sm font-medium text-gray-900 border-none p-0 focus:outline-none focus:ring-0 placeholder:text-gray-400 placeholder:font-normal">
            </div>

            <!-- Select Filter -->
            <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-gray-200 bg-white shadow-2xs focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all w-full sm:w-60">
                <select wire:model.live="packageFilter" class="w-full bg-transparent text-sm font-medium text-gray-900 border-none p-0 focus:outline-none focus:ring-0 cursor-pointer appearance-none">
                    <option value="">Semua Paket</option>
                    @foreach($packages as $pkg)
                        <option value="{{ $pkg->id }}">{{ $pkg->name }} ({{ $pkg->service->category->shortLabel() }})</option>
                    @endforeach
                </select>
                <svg class="w-4 h-4 text-gray-400 shrink-0 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
        <button wire:click="create"
                class="bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-md shadow-primary/20 flex items-center gap-2 whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Promo
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-100 border-b border-gray-200 text-gray-500 uppercase text-xs tracking-wider font-bold">
                    <tr>
                        <th class="px-6 py-4">Nama Promo</th>
                        <th class="px-6 py-4">Paket Terkait</th>
                        <th class="px-6 py-4">Diskon</th>
                        <th class="px-6 py-4">Masa Berlaku</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($promos as $promo)
                        <tr class="hover:bg-primary/5 transition-colors group">
                            <!-- Nama Promo -->
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900 text-base mb-0.5">{{ $promo->name }}</div>
                                @if($promo->description)
                                    <div class="text-xs text-gray-500 truncate max-w-[220px]" title="{{ $promo->description }}">
                                        {{ Str::limit($promo->description, 50) }}
                                    </div>
                                @endif
                            </td>

                            <!-- Paket -->
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wide {{ $promo->package->service->category->badgeClasses() }}">
                                    {{ $promo->package->service->category->shortLabel() }}
                                </span>
                                <div class="text-sm text-gray-700 font-semibold mt-1.5">{{ $promo->package->name }}</div>
                                <div class="text-xs text-gray-400">
                                    Harga dasar: Rp {{ number_format($promo->package->price, 0, ',', '.') }}
                                </div>
                            </td>

                            <!-- Diskon -->
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full border text-xs font-bold {{ $promo->discount_type->badgeClasses() }}">
                                    @if($promo->discount_type->value === 'percentage')
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M17.707 4.293a1 1 0 010 1.414l-12 12A1 1 0 114.293 6.293l12-12a1 1 0 011.414 0zM5 7a2 2 0 114 0A2 2 0 015 7zm6 6a2 2 0 114 0 2 2 0 01-4 0z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                    {{ $promo->getFormattedDiscount() }} OFF
                                </span>
                                <div class="text-xs text-green-600 font-semibold mt-1.5">
                                    → Rp {{ number_format($promo->getDiscountedPrice($promo->package->price), 0, ',', '.') }}
                                </div>
                            </td>

                            <!-- Masa Berlaku -->
                            <td class="px-6 py-4 text-xs text-gray-600">
                                @if($promo->starts_at || $promo->ends_at)
                                    <div class="flex flex-col gap-0.5">
                                        @if($promo->starts_at)
                                            <span><span class="text-gray-400">Mulai:</span> {{ $promo->starts_at->format('d M Y') }}</span>
                                        @else
                                            <span class="text-gray-400 italic">Mulai: —</span>
                                        @endif
                                        @if($promo->ends_at)
                                            <span><span class="text-gray-400">Akhir:</span> {{ $promo->ends_at->format('d M Y') }}</span>
                                        @else
                                            <span class="text-gray-400 italic">Akhir: —</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-gray-400 italic">Tanpa batas waktu</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 text-center">
                                @if($promo->isCurrentlyActive())
                                    <span class="px-3 py-1 bg-green-100/80 text-green-700 border border-green-200 rounded-full text-xs font-bold tracking-wide">Aktif</span>
                                @elseif(!$promo->is_active)
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 border border-gray-200 rounded-full text-xs font-bold tracking-wide">Nonaktif</span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-600 border border-red-200 rounded-full text-xs font-bold tracking-wide">Kedaluwarsa</span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="edit('{{ $promo->id }}')"
                                            class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                            title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete('{{ $promo->id }}')"
                                            class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors"
                                            title="Hapus">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-gray-500 bg-gray-50/50">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-gray-100">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <p class="text-base font-semibold text-gray-700">Belum ada promo</p>
                                <p class="text-sm mt-1">Mulai dengan menambahkan promo baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $promos->links() }}
        </div>
    </div>

    <!-- Modal Form -->
    <div x-data="{ open: @entangle('showModal') }">
        <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">

                <!-- Overlay -->
                <div x-show="open"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="open = false"
                     class="fixed inset-0 transition-opacity bg-gray-900/40 backdrop-blur-sm" aria-hidden="true"></div>

                <!-- Panel -->
                <div x-show="open"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block w-full max-w-2xl overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl relative z-50 border border-gray-100 my-8">

                    <!-- Modal Header -->
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $isEdit ? 'Edit Promo' : 'Tambah Promo Baru' }}</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Isi detail promo yang akan diterapkan ke paket layanan.</p>
                        </div>
                        <button @click="open = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Form -->
                    <form wire:submit.prevent="save">
                        <div class="p-6 space-y-5">

                            <!-- Nama Promo -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Nama Promo <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="form.name"
                                       placeholder="Contoh: Promo Lebaran 2025"
                                       class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                @error('form.name')
                                    <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Pilih Paket -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Paket Layanan <span class="text-red-500">*</span>
                                </label>
                                <select wire:model="form.package_id"
                                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                    <option value="">-- Pilih Paket --</option>
                                    @foreach($packages as $pkg)
                                        <option value="{{ $pkg->id }}">
                                            {{ $pkg->name }} ({{ $pkg->service->category->shortLabel() }}) — Rp {{ number_format($pkg->price, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('form.package_id')
                                    <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Tipe & Nilai Diskon -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                        Tipe Diskon <span class="text-red-500">*</span>
                                    </label>
                                    <select wire:model.live="form.discount_type"
                                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                        <option value="percentage">Persentase (%)</option>
                                        <option value="fixed">Nominal (Rp)</option>
                                    </select>
                                    @error('form.discount_type')
                                        <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                        @if($form->discount_type === 'percentage')
                                            Nilai Diskon (%) <span class="text-red-500">*</span>
                                        @else
                                            Nilai Diskon (Rp) <span class="text-red-500">*</span>
                                        @endif
                                    </label>
                                    <div class="flex rounded-xl border border-gray-200 bg-gray-50 overflow-hidden focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 focus-within:bg-white transition-all">
                                        <span class="inline-flex items-center px-3.5 bg-gray-100 text-gray-500 font-bold text-sm border-r border-gray-200 select-none">
                                            {{ $form->discount_type === 'percentage' ? '%' : 'Rp' }}
                                        </span>
                                        <input type="number" wire:model="form.discount_value"
                                               min="0.01"
                                               step="{{ $form->discount_type === 'percentage' ? '0.01' : '1000' }}"
                                               @if($form->discount_type === 'percentage') max="100" @endif
                                               placeholder="{{ $form->discount_type === 'percentage' ? 'Contoh: 10' : 'Contoh: 500000' }}"
                                               class="w-full bg-transparent px-4 py-2.5 text-sm font-mono border-0 focus:ring-0 focus:outline-none text-gray-900">
                                    </div>
                                    @error('form.discount_value')
                                        <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Masa Berlaku -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                        Mulai Berlaku <span class="text-gray-400 font-normal text-xs">(opsional)</span>
                                    </label>
                                    <input type="datetime-local" wire:model="form.starts_at"
                                           class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                    @error('form.starts_at')
                                        <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                        Berakhir <span class="text-gray-400 font-normal text-xs">(opsional)</span>
                                    </label>
                                    <input type="datetime-local" wire:model="form.ends_at"
                                           class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                    @error('form.ends_at')
                                        <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Deskripsi <span class="text-gray-400 font-normal text-xs">(opsional)</span>
                                </label>
                                <textarea wire:model="form.description" rows="2"
                                          placeholder="Keterangan singkat tentang promo ini..."
                                          class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"></textarea>
                                @error('form.description')
                                    <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Toggle Aktif -->
                            <label class="flex items-center gap-3 cursor-pointer p-3 bg-gray-50 rounded-xl border border-gray-200 hover:bg-gray-100 transition-colors">
                                <input type="checkbox" wire:model="form.is_active"
                                       class="rounded text-primary focus:ring-primary h-5 w-5 border-gray-300">
                                <div>
                                    <span class="text-sm font-semibold text-gray-700">Aktifkan Promo</span>
                                    <p class="text-xs text-gray-500">Promo hanya tampil jika diaktifkan dan masih dalam masa berlaku.</p>
                                </div>
                            </label>

                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-gray-50/80 px-6 py-4 border-t border-gray-100 flex justify-end gap-3 rounded-b-2xl">
                            <button type="button" @click="open = false"
                                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-colors shadow-sm">
                                Batal
                            </button>
                            <button type="submit"
                                    class="px-5 py-2.5 text-sm font-medium text-white bg-primary rounded-xl hover:bg-primary-dark transition-colors shadow-sm shadow-primary/30 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Promo
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
