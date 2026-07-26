<div>
    <!-- Header Actions -->
    <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <!-- Search Input -->
        <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl border border-gray-200 bg-white shadow-2xs focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all w-full sm:w-72">
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   placeholder="Cari spesifikasi videotron..." 
                   class="w-full bg-transparent text-sm font-medium text-gray-900 border-none p-0 focus:outline-none focus:ring-0 placeholder:text-gray-400 placeholder:font-normal">
        </div>

        <button wire:click="create" class="bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-md shadow-primary/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Spek Videotron
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50/80 border-b border-gray-200/80 text-gray-500 uppercase text-xs tracking-wider font-bold">
                    <tr>
                        <th class="px-6 py-4">Produk</th>
                        <th class="px-6 py-4">Merek / Model</th>
                        <th class="px-6 py-4">Spesifikasi & Refresh Rate</th>
                        <th class="px-6 py-4">Ukuran Panel & Pixel/m</th>
                        <th class="px-6 py-4">Harga/m²</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($specs as $spec)
                        <tr class="hover:bg-primary/5 transition-colors group">
                            <!-- Image Thumbnail -->
                            <td class="px-6 py-4">
                                @if($spec->image_url)
                                    <img src="{{ $spec->image_url }}" alt="{{ $spec->brand }}" class="w-14 h-14 object-cover rounded-xl border border-gray-200 shadow-xs">
                                @else
                                    <div class="w-14 h-14 bg-gray-100 rounded-xl border border-gray-200 flex items-center justify-center text-gray-400">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </td>

                            <!-- Brand & Model -->
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900 text-base mb-0.5">{{ $spec->brand }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ $spec->model ?: '-' }}</div>
                            </td>

                            <!-- Specs & Refresh Rate -->
                            <td class="px-6 py-4">
                                <div class="text-gray-900 font-bold">⚡ {{ $spec->power_consumption_watt ?? 350 }} W/m² <span class="text-gray-400 font-normal mx-1">&bull;</span> {{ ucfirst($spec->type) }}</div>
                                <div class="text-xs font-semibold text-amber-600 mt-1 flex items-center gap-2">
                                    <span>☀️ {{ $spec->brightness }} nits</span>
                                    <span class="text-gray-300">•</span>
                                    <span>🔄 {{ $spec->refresh_rate ?? 3840 }} Hz</span>
                                </div>
                            </td>

                            <!-- Panel Size & Pixel/m -->
                            <td class="px-6 py-4">
                                <div class="mb-1">
                                    <span class="px-2.5 py-1 bg-gray-100 text-gray-700 rounded-md text-xs font-semibold font-mono border border-gray-200">
                                        {{ $spec->panel_width_cm }} &times; {{ $spec->panel_height_cm }} cm
                                    </span>
                                </div>
                                <span class="text-xs text-gray-500 font-medium">
                                    {{ $spec->pixels_per_meter ?? 256 }} px/m
                                </span>
                            </td>

                            <!-- Price -->
                            <td class="px-6 py-4">
                                <span class="font-bold text-primary text-base">Rp {{ number_format($spec->price_per_m2, 0, ',', '.') }}</span>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 text-center">
                                @if($spec->is_active)
                                    <span class="px-3 py-1 bg-green-100/80 text-green-700 border border-green-200 rounded-full text-xs font-bold tracking-wide">Aktif</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 border border-gray-200 rounded-full text-xs font-bold tracking-wide">Draft</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 transition-opacity">
                                    <button wire:click="edit('{{ $spec->id }}')" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors tooltip" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button wire:click="confirmDelete('{{ $spec->id }}')"  class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors tooltip" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center text-gray-500 bg-gray-50/50">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-gray-100">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <p class="text-base font-semibold text-gray-700">Tidak ada spesifikasi videotron.</p>
                                <p class="text-sm mt-1">Mulai dengan menambahkan spek videotron baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $specs->links() }}
        </div>
    </div>

    <!-- Modal Form -->
    <div x-data="{ open: @entangle('showModal') }">
        <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                
                <div x-show="open" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="open = false" 
                     class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-xs" aria-hidden="true"></div>

                <div x-show="open" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block w-full max-w-2xl overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl relative z-50 border border-gray-100 my-8">
                    
                    <!-- Header Modal -->
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/70">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center text-primary font-bold">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-gray-900">{{ $isEdit ? 'Edit Spesifikasi Videotron' : 'Tambah Spesifikasi Videotron' }}</h3>
                        </div>
                        <button @click="open = false" class="text-gray-400 hover:text-gray-600 transition-colors p-1 rounded-lg hover:bg-gray-100">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <form wire:submit.prevent="save">
                        <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
                            
                            <!-- Foto Produk -->
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Foto Produk Videotron</label>
                                <div class="p-4 bg-gray-50/80 rounded-xl border border-dashed border-gray-300 hover:border-primary/50 transition-colors">
                                    <div class="flex items-center gap-4">
                                        @if ($form->image)
                                            <img src="{{ $form->image->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-xl border border-gray-200 shadow-xs shrink-0">
                                        @elseif ($form->existing_image)
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($form->existing_image) }}" class="w-16 h-16 object-cover rounded-xl border border-gray-200 shadow-xs shrink-0">
                                        @else
                                            <div class="w-16 h-16 bg-white rounded-xl border border-gray-200 flex items-center justify-center text-gray-400 shrink-0 shadow-2xs">
                                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                        
                                        <div class="flex-1">
                                            <label class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-700 hover:bg-primary hover:text-white hover:border-primary cursor-pointer transition-all shadow-2xs">
                                                <svg class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                                <span>Pilih Foto Produk</span>
                                                <input type="file" wire:model="form.image" accept="image/*" class="hidden">
                                            </label>
                                            <p class="text-[11px] text-gray-400 mt-1.5 font-medium">Format JPG, PNG, WEBP (Maksimal 2MB)</p>
                                        </div>
                                    </div>
                                </div>
                                @error('form.image') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>

                            <!-- Group 1: Informasi Produk -->
                            <div class="space-y-4">
                                <h4 class="text-xs font-bold text-primary uppercase tracking-wider pb-1 border-b border-gray-100">Informasi Produk</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Merek <span class="text-red-500">*</span></label>
                                        <input type="text" 
                                               wire:model="form.brand" 
                                               placeholder="Cth: Qiangli, Novastar, dll" 
                                               class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 placeholder:font-normal outline-none">
                                        @error('form.brand') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Model / Tipe</label>
                                        <input type="text" 
                                               wire:model="form.model" 
                                               placeholder="Opsional, Cth: Q3 Pro" 
                                               class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 placeholder:font-normal outline-none">
                                        @error('form.model') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Group 2: Spesifikasi Teknis -->
                            <div class="space-y-4 pt-1">
                                <h4 class="text-xs font-bold text-primary uppercase tracking-wider pb-1 border-b border-gray-100">Spesifikasi Teknis</h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Konsumsi Watt (W/m²) <span class="text-red-500">*</span></label>
                                        <input type="number" 
                                               wire:model="form.power_consumption_watt" 
                                               step="10" 
                                               min="0" 
                                               placeholder="Contoh: 350" 
                                               class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-mono placeholder:text-gray-400 placeholder:font-normal outline-none">
                                        @error('form.power_consumption_watt') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Brightness (nits) <span class="text-red-500">*</span></label>
                                        <input type="number" 
                                               wire:model="form.brightness" 
                                               step="100" 
                                               min="0" 
                                               placeholder="Cth: 5000" 
                                               class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-mono placeholder:text-gray-400 placeholder:font-normal outline-none">
                                        @error('form.brightness') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Refresh Rate (Hz) <span class="text-red-500">*</span></label>
                                        <input type="number" 
                                               wire:model="form.refresh_rate" 
                                               step="60" 
                                               min="0" 
                                               placeholder="Cth: 3840" 
                                               class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-mono placeholder:text-gray-400 placeholder:font-normal outline-none">
                                        @error('form.refresh_rate') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Lebar Panel (cm) <span class="text-red-500">*</span></label>
                                        <input type="number" 
                                               wire:model="form.panel_width_cm" 
                                               step="0.1" 
                                               placeholder="Cth: 50" 
                                               class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-mono placeholder:text-gray-400 placeholder:font-normal outline-none">
                                        @error('form.panel_width_cm') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Tinggi Panel (cm) <span class="text-red-500">*</span></label>
                                        <input type="number" 
                                               wire:model="form.panel_height_cm" 
                                               step="0.1" 
                                               placeholder="Cth: 50" 
                                               class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-mono placeholder:text-gray-400 placeholder:font-normal outline-none">
                                        @error('form.panel_height_cm') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Pixel/Meter (Default 256)</label>
                                        <input type="number" 
                                               wire:model="form.pixels_per_meter" 
                                               step="1" 
                                               min="1" 
                                               placeholder="256" 
                                               class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-mono placeholder:text-gray-400 placeholder:font-normal outline-none">
                                        @error('form.pixels_per_meter') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Group 3: Harga & Kategori -->
                            <div class="space-y-4 pt-1">
                                <h4 class="text-xs font-bold text-primary uppercase tracking-wider pb-1 border-b border-gray-100">Harga & Penggunaan</h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Harga per m² (Rp) <span class="text-red-500">*</span></label>
                                        <input type="number" 
                                               wire:model="form.price_per_m2" 
                                               step="1000" 
                                               placeholder="Cth: 1500000" 
                                               class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-mono placeholder:text-gray-400 placeholder:font-normal outline-none">
                                        @error('form.price_per_m2') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Penggunaan <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <select wire:model="form.type" 
                                                    class="w-full appearance-none rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer outline-none">
                                                <option value="indoor">Indoor</option>
                                                <option value="outdoor">Outdoor</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('form.type') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Deskripsi Singkat</label>
                                    <textarea wire:model="form.description" 
                                              rows="2" 
                                              placeholder="Keterangan tambahan (opsional)" 
                                              class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-medium text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 placeholder:font-normal outline-none"></textarea>
                                    @error('form.description') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="pt-1">
                                    <label class="flex items-center gap-3 cursor-pointer p-3 bg-gray-50/80 rounded-xl border border-gray-200/80 hover:bg-gray-100/80 transition-all w-max pr-6 shadow-2xs">
                                        <input type="checkbox" wire:model="form.is_active" class="rounded-md text-primary focus:ring-primary h-4 w-4 border-gray-300">
                                        <span class="text-xs font-bold text-gray-700">Aktif (Bisa dipilih pelanggan)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Footer Modal -->
                        <div class="bg-gray-50/80 px-6 py-4 border-t border-gray-100 flex justify-end gap-3 rounded-b-2xl">
                            <button type="button" @click="open = false" class="px-4 py-2 text-xs font-bold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-all shadow-2xs">Batal</button>
                            <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-primary rounded-xl hover:bg-primary-dark transition-all shadow-md shadow-primary/20 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Spesifikasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
