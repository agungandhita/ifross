<div>
    <!-- Header Actions -->
    <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
            <!-- Search Bar -->
            <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl border border-gray-200 bg-white shadow-2xs focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all w-full sm:w-72">
                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari item tambahan (addon)..." class="w-full bg-transparent text-sm font-medium text-gray-900 border-none p-0 focus:outline-none focus:ring-0 placeholder:text-gray-400 placeholder:font-normal">
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
            Tambah Addon
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50/80 border-b border-gray-200/80 text-gray-500 uppercase text-xs tracking-wider font-bold">
                    <tr>
                        <th class="px-6 py-4">Nama Item Addon</th>
                        <th class="px-6 py-4">Layanan Terkait</th>
                        <th class="px-6 py-4">Harga Satuan</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($addons as $addon)
                        <tr class="hover:bg-primary/5 transition-colors group">
                            <td class="px-6 py-4 font-bold text-gray-900 text-base">
                                {{ $addon->name }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-primary/10 text-primary rounded-md text-xs font-bold uppercase tracking-wide">
                                    {{ $addon->service->category->shortLabel() }}
                                </span>
                                <div class="text-sm text-gray-500 font-medium mt-1.5">{{ $addon->service->name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-primary text-base">Rp {{ number_format($addon->price, 0, ',', '.') }}</span>
                                <span class="text-gray-500 text-sm font-medium">/ {{ $addon->unit }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($addon->is_active)
                                    <span class="px-3 py-1 bg-green-100/80 text-green-700 border border-green-200 rounded-full text-xs font-bold tracking-wide">Aktif</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 border border-gray-200 rounded-full text-xs font-bold tracking-wide">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 transition-opacity">
                                    <button wire:click="edit('{{ $addon->id }}')" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors tooltip" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button wire:click="confirmDelete('{{ $addon->id }}')"  class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors tooltip" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-gray-500 bg-gray-50/50">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-gray-100">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <p class="text-base font-semibold text-gray-700">Tidak ada item tambahan (addon)</p>
                                <p class="text-sm mt-1">Mulai dengan menambahkan addon baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $addons->links() }}
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
                     class="inline-block w-full max-w-lg overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl relative z-50 border border-gray-100 my-8">
                    
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/70">
                        <h3 class="text-base font-bold text-gray-900">{{ $isEdit ? 'Edit Item Addon' : 'Tambah Item Addon' }}</h3>
                        <button @click="open = false" class="text-gray-400 hover:text-gray-600 transition-colors p-1 rounded-lg hover:bg-gray-100">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <form wire:submit.prevent="save">
                        <div class="p-6 space-y-5">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Item <span class="text-red-500">*</span></label>
                                <input type="text" wire:model="form.name" placeholder="Contoh: Genset Silent 100 kVA / Operator Tambahan" class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 placeholder:font-normal outline-none">
                                @error('form.name') <span class="text-red-500 text-xs mt-1.5 font-medium block">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1.5">Layanan Terkait <span class="text-red-500">*</span></label>
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
                                @error('form.service_id') <span class="text-red-500 text-xs mt-1.5 font-medium block">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Harga (Rp) <span class="text-red-500">*</span></label>
                                    <input type="number" wire:model="form.price" min="0" step="1000" placeholder="Contoh: 150000" class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all font-mono placeholder:text-gray-400 placeholder:font-normal outline-none">
                                    @error('form.price') <span class="text-red-500 text-xs mt-1.5 font-medium block">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Satuan <span class="text-red-500">*</span></label>
                                    <input type="text" wire:model="form.unit" placeholder="Contoh: Hari / Unit / Set / Meter" class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 placeholder:font-normal outline-none">
                                    @error('form.unit') <span class="text-red-500 text-xs mt-1.5 font-medium block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1.5">Deskripsi Singkat</label>
                                <textarea wire:model="form.description" rows="2" placeholder="Tuliskan deskripsi singkat item tambahan ini..." class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-medium text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 placeholder:font-normal outline-none"></textarea>
                                @error('form.description') <span class="text-red-500 text-xs mt-1.5 font-medium block">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="pt-1">
                                <label class="inline-flex items-center gap-3 cursor-pointer p-3 bg-gray-50/80 rounded-xl border border-gray-200/80 hover:bg-gray-100/80 transition-all shadow-2xs">
                                    <input type="checkbox" wire:model="form.is_active" class="rounded text-primary focus:ring-primary h-4 w-4 border-gray-300">
                                    <span class="text-xs font-bold text-gray-700">Aktif (Bisa dipesan)</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50/80 px-6 py-4 border-t border-gray-100 flex justify-end gap-3 rounded-b-2xl">
                            <button type="button" @click="open = false" class="px-4 py-2 text-xs font-bold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-all shadow-2xs">Batal</button>
                            <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-primary rounded-xl hover:bg-primary-dark transition-all shadow-md shadow-primary/20 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Addon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
