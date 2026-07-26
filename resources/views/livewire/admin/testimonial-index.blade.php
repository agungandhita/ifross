<div>
    <!-- Header Actions -->
    <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <!-- Search Bar -->
        <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl border border-gray-200 bg-white shadow-2xs focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all w-full sm:w-72">
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari testimoni pelanggan..." class="w-full bg-transparent text-sm font-medium text-gray-900 border-none p-0 focus:outline-none focus:ring-0 placeholder:text-gray-400 placeholder:font-normal">
        </div>
        <button wire:click="create" class="bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-md shadow-primary/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Testimoni
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50/80 border-b border-gray-200/80 text-gray-500 uppercase text-xs tracking-wider font-bold">
                    <tr>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Ulasan</th>
                        <th class="px-6 py-4">Terkait Portofolio</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($testimonials as $testimonial)
                        <tr class="hover:bg-primary/5 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200 shadow-sm">
                                        @if($testimonial->photo)
                                            <img src="{{ $testimonial->photo }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6 text-gray-400 m-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 text-base mb-0.5">{{ $testimonial->name }}</div>
                                        <div class="text-sm font-medium text-gray-500">{{ $testimonial->position ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex text-amber-400 mb-1.5">
                                    @for($i=1; $i<=5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                </div>
                                <div class="text-gray-600 truncate max-w-xs text-sm" title="{{ $testimonial->review }}">{{ Str::limit($testimonial->review, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                @if($testimonial->portfolio)
                                    <span class="text-sm font-medium text-gray-800">{{ Str::limit($testimonial->portfolio->title, 30) }}</span>
                                @else
                                    <span class="text-gray-400 italic text-xs font-medium">Tidak Ada</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($testimonial->is_active)
                                    <span class="px-3 py-1 bg-green-100/80 text-green-700 border border-green-200 rounded-full text-xs font-bold tracking-wide">Aktif</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 border border-gray-200 rounded-full text-xs font-bold tracking-wide">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 transition-opacity">
                                    <button wire:click="edit('{{ $testimonial->id }}')" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors tooltip" title="Edit">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button wire:click="confirmDelete('{{ $testimonial->id }}')"  class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors tooltip" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-gray-500 bg-gray-50/50">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-gray-100">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                </div>
                                <p class="text-base font-semibold text-gray-700">Tidak ada testimoni pelanggan.</p>
                                <p class="text-sm mt-1">Mulai dengan menambahkan testimoni baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $testimonials->links() }}
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
                    
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/70">
                        <h3 class="text-base font-bold text-gray-900">{{ $isEdit ? 'Edit Testimoni' : 'Tambah Testimoni' }}</h3>
                        <button @click="open = false" class="text-gray-400 hover:text-gray-600 transition-colors p-1 rounded-lg hover:bg-gray-100">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <form wire:submit.prevent="save">
                        <div class="p-6 space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Pelanggan <span class="text-red-500">*</span></label>
                                    <input type="text" wire:model="form.name" placeholder="Contoh: Budi Santoso" class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 placeholder:font-normal outline-none">
                                    @error('form.name') <span class="text-red-500 text-xs mt-1.5 font-medium block">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Jabatan / Instansi</label>
                                    <input type="text" wire:model="form.position" placeholder="Contoh: Event Manager PT Pertamina" class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 placeholder:font-normal outline-none">
                                    @error('form.position') <span class="text-red-500 text-xs mt-1.5 font-medium block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Rating (Bintang) <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <select wire:model="form.rating" class="w-full appearance-none rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer text-amber-500 font-bold outline-none">
                                            <option value="5">⭐⭐⭐⭐⭐ (5 - Sangat Memuaskan)</option>
                                            <option value="4">⭐⭐⭐⭐ (4 - Memuaskan)</option>
                                            <option value="3">⭐⭐⭐ (3 - Cukup)</option>
                                            <option value="2">⭐⭐ (2 - Kurang)</option>
                                            <option value="1">⭐ (1 - Buruk)</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('form.rating') <span class="text-red-500 text-xs mt-1.5 font-medium block">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Terkait Portofolio (Opsional)</label>
                                    <div class="relative">
                                        <select wire:model="form.portfolio_id" class="w-full appearance-none rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-semibold text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer outline-none">
                                            <option value="">-- Tidak Terkait Portofolio --</option>
                                            @foreach($portfolios as $portfolio)
                                                <option value="{{ $portfolio->id }}">{{ Str::limit($portfolio->title, 40) }}</option>
                                            @endforeach
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('form.portfolio_id') <span class="text-red-500 text-xs mt-1.5 font-medium block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1.5">Isi Testimoni <span class="text-red-500">*</span></label>
                                <textarea wire:model="form.review" rows="4" placeholder="Tuliskan ulasan atau pengalaman kepuasan pelanggan..." class="w-full rounded-xl border border-gray-200 bg-gray-50/70 px-4 py-2.5 text-sm font-medium text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 placeholder:font-normal outline-none"></textarea>
                                @error('form.review') <span class="text-red-500 text-xs mt-1.5 font-medium block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-2">Foto / Avatar (Opsional)</label>
                                
                                @if($form->photo || $form->existingPhoto)
                                    <div class="mb-3 relative inline-block">
                                        <img src="{{ $form->photo ? $form->photo->temporaryUrl() : $form->existingPhoto }}" class="w-16 h-16 rounded-full object-cover border border-gray-200 shadow-sm">
                                        <button type="button" wire:click="removePhoto" class="absolute -top-1 -right-1 bg-red-500/90 text-white rounded-full p-1.5 hover:bg-red-600 transition-colors backdrop-blur-sm">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                @endif
                                
                                <div class="p-4 bg-gray-50/80 rounded-xl border border-dashed border-gray-300 hover:border-primary/50 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white rounded-full border border-gray-200 flex items-center justify-center text-gray-400 shrink-0 shadow-2xs">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        </div>
                                        <div class="flex-1">
                                            <label class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-700 hover:bg-primary hover:text-white hover:border-primary cursor-pointer transition-all shadow-2xs">
                                                <svg class="w-4 h-4 text-primary group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                                <span>Pilih Foto Avatar</span>
                                                <input type="file" wire:model="form.photo" accept="image/*" class="hidden">
                                            </label>
                                            <p class="text-[11px] text-gray-400 mt-1.5 font-medium">Format JPG, PNG, WEBP (Maksimal 2MB)</p>
                                        </div>
                                    </div>
                                </div>
                                <div wire:loading wire:target="form.photo" class="text-xs text-primary mt-2 font-semibold">Mengunggah foto...</div>
                                @error('form.photo') <span class="text-red-500 text-xs mt-1.5 font-medium block">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="pt-1">
                                <label class="inline-flex items-center gap-3 cursor-pointer p-3 bg-gray-50/80 rounded-xl border border-gray-200/80 hover:bg-gray-100/80 transition-all shadow-2xs">
                                    <input type="checkbox" wire:model="form.is_active" class="rounded text-primary focus:ring-primary h-4 w-4 border-gray-300">
                                    <span class="text-xs font-bold text-gray-700">Tampilkan (Aktif)</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50/80 px-6 py-4 border-t border-gray-100 flex justify-end gap-3 rounded-b-2xl">
                            <button type="button" @click="open = false" class="px-4 py-2 text-xs font-bold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-all shadow-2xs">Batal</button>
                            <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-primary rounded-xl hover:bg-primary-dark transition-all shadow-md shadow-primary/20 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Testimoni
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
