<div>

    <!-- Header Actions -->
    <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
            <!-- Search Bar -->
            <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl border border-gray-200 bg-white shadow-2xs focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all w-full sm:w-72">
                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari paket layanan..." class="w-full bg-transparent text-sm font-medium text-gray-900 border-none p-0 focus:outline-none focus:ring-0 placeholder:text-gray-400 placeholder:font-normal">
            </div>

            <!-- Select Filter -->
            <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-gray-200 bg-white shadow-2xs focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all w-full sm:w-56">
                <select wire:model.live="serviceFilter" class="w-full bg-transparent text-sm font-medium text-gray-900 border-none p-0 focus:outline-none focus:ring-0 cursor-pointer appearance-none">
                    <option value="">Semua Layanan</option>
                    @foreach($services as $srv)
                        <option value="{{ $srv->id }}">{{ $srv->name }} ({{ $srv->category->shortLabel() }})</option>
                    @endforeach
                </select>
                <svg class="w-4 h-4 text-gray-400 shrink-0 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
        <button wire:click="create" class="bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-md shadow-primary/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Paket
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-100 border-b border-gray-200 text-gray-500 uppercase text-xs tracking-wider font-bold">
                    <tr>
                        <th class="px-6 py-4">Nama Paket</th>
                        <th class="px-6 py-4">Layanan</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($packages as $package)
                        <tr class="hover:bg-primary/5 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200 shadow-sm">
                                        @if($package->image)
                                            <img src="{{ $package->image }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6 text-gray-400 m-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 text-base mb-0.5">{{ $package->name }}</div>
                                        <div class="text-xs text-gray-500 truncate max-w-[250px]" title="{{ $package->description }}">{{ Str::limit($package->description, 40) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wide {{ $package->service->category->badgeClasses() }}">
                                    {{ $package->service->category->shortLabel() }}
                                </span>
                                <div class="text-sm text-gray-500 font-medium mt-1.5">{{ $package->service->name }}</div>
                            </td>
                            <td class="px-6 py-4 font-bold text-primary text-base">
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($package->is_active)
                                    <span class="px-3 py-1 bg-green-100/80 text-green-700 border border-green-200 rounded-full text-xs font-bold tracking-wide">Aktif</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 border border-gray-200 rounded-full text-xs font-bold tracking-wide">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 transition-opacity">
                                    <button wire:click="edit('{{ $package->id }}')" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors tooltip" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button wire:click="confirmDelete('{{ $package->id }}')"  class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors tooltip" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-gray-500 bg-gray-50/50">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-gray-100">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <p class="text-base font-semibold text-gray-700">Tidak ada paket layanan</p>
                                <p class="text-sm mt-1">Mulai dengan menambahkan paket baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $packages->links() }}
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
                     class="fixed inset-0 transition-opacity bg-gray-900/40 backdrop-blur-sm" aria-hidden="true"></div>

                <div x-show="open" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block w-full max-w-2xl overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl relative z-50 border border-gray-100 my-8">
                    
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-900">{{ $isEdit ? 'Edit Paket Layanan' : 'Tambah Paket Layanan' }}</h3>
                        <button @click="open = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <form wire:submit.prevent="save">
                        <div class="p-6 space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Paket <span class="text-red-500">*</span></label>
                                    <input type="text" wire:model="form.name" placeholder="Contoh: Paket Multicam Standard 3 Kamera" class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 placeholder:font-normal outline-none">
                                    @error('form.name') <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Layanan Utama <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <select wire:model="form.service_id" class="w-full appearance-none rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer outline-none">
                                            <option value="">-- Pilih Layanan --</option>
                                            @foreach($services as $srv)
                                                <option value="{{ $srv->id }}">{{ $srv->name }} ({{ $srv->category->shortLabel() }})</option>
                                            @endforeach
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('form.service_id') <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Harga Dasar (Rp) <span class="text-red-500">*</span></label>
                                <input type="number" wire:model="form.price" min="0" step="1000" placeholder="Contoh: 3500000" class="w-full md:w-1/2 rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-mono placeholder:text-gray-400 placeholder:font-normal outline-none">
                                @error('form.price') <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Singkat <span class="text-red-500">*</span></label>
                                <textarea wire:model="form.description" rows="3" placeholder="Tuliskan deskripsi singkat mengenai fitur dan peruntukan paket ini..." class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-medium text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 placeholder:font-normal outline-none"></textarea>
                                @error('form.description') <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kelengkapan Paket (Satu per baris)</label>
                                    <textarea wire:model="form.features" rows="5" class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-medium text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 placeholder:font-normal outline-none" placeholder="Contoh:&#10;Kamera Sony A7 III (2 Unit)&#10;Mixer Video Blackmagic ATEM&#10;Operator Professional (2 Orang)"></textarea>
                                    @error('form.features') <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Metadata (Format: Kunci: Nilai)</label>
                                    <textarea wire:model="form.metadata" rows="5" class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-medium text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-mono placeholder:text-gray-400 placeholder:font-normal outline-none" placeholder="Contoh:&#10;Kamera: 2 Unit&#10;Resolusi: 1080p Full HD&#10;Durasi: Max 6 Jam"></textarea>
                                    <p class="text-xs text-gray-500 mt-1.5 font-medium">Gunakan format "Kunci: Nilai" untuk properti spesifik per layanan.</p>
                                    @error('form.metadata') <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar / Thumbnail</label>
                                
                                @if($form->image)
                                    <div class="mb-3 relative inline-block">
                                        <img src="{{ $form->image->temporaryUrl() }}" class="w-32 h-32 rounded-xl object-cover border border-gray-200 shadow-sm" alt="Preview">
                                    </div>
                                @elseif($form->existingImage)
                                    <div class="mb-3 relative inline-block">
                                        <img src="{{ $form->existingImage }}" class="w-32 h-32 rounded-xl object-cover border border-gray-200 shadow-sm" alt="Gambar saat ini">
                                        <span class="absolute top-1 right-1 bg-gray-800/60 text-white text-[10px] px-1.5 py-0.5 rounded font-medium">Saat ini</span>
                                    </div>
                                @endif
                                
                                <input type="file" wire:model="form.image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-colors">
                                <div wire:loading wire:target="form.image" class="text-sm text-primary mt-2 font-medium">Mengunggah...</div>
                                @error('form.image') <span class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="pt-2">
                                <label class="inline-flex items-center gap-3 cursor-pointer p-3 bg-gray-50 rounded-xl border border-gray-200 hover:bg-gray-100 transition-colors">
                                    <input type="checkbox" wire:model="form.is_active" class="rounded text-primary focus:ring-primary h-5 w-5 border-gray-300">
                                    <span class="text-sm font-semibold text-gray-700">Tampilkan Paket ini (Aktif)</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50/80 px-6 py-4 border-t border-gray-100 flex justify-end gap-3 rounded-b-2xl">
                            <button type="button" @click="open = false" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-colors shadow-sm">Batal</button>
                            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-primary rounded-xl hover:bg-primary-dark transition-colors shadow-sm shadow-primary/30 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
