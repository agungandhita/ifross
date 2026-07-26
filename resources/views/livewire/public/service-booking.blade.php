<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-12" id="{{ $service->slug }}">
    
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Toggle Booking Type -->
        <div class="bg-white p-2 rounded-xl border border-gray-100 flex gap-2 w-max shadow-sm">
            @if($service->packages->count() > 0)
                <button wire:click="$set('bookingType', 'package')"
                        class="px-6 py-2.5 rounded-lg text-sm font-semibold transition-all {{ $bookingType === 'package' ? 'bg-primary text-white shadow' : 'text-gray-500 hover:text-gray-900' }}">
                    Bundling Package
                </button>
            @endif
            <button wire:click="$set('bookingType', 'custom')"
                    class="px-6 py-2.5 rounded-lg text-sm font-semibold transition-all {{ $bookingType === 'custom' ? 'bg-primary text-white shadow' : 'text-gray-500 hover:text-gray-900' }}">
                Custom Order
            </button>
        </div>

        @if($bookingType === 'package')
            <!-- Packages Selection -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Pilih Paket</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    @foreach($service->packages as $package)
                        @php
                            $promo = $package->activePromo;
                            $hasPromo = $promo && $promo->isCurrentlyActive();
                            $promoPrice = $hasPromo ? $promo->getDiscountedPrice($package->price) : null;
                        @endphp
                        <label class="relative flex flex-col justify-between cursor-pointer rounded-xl border p-4 transition-all duration-200 {{ $selectedPackageId == $package->id ? 'border-primary bg-primary/5 ring-2 ring-primary/20 shadow-sm' : 'border-gray-200 hover:border-primary/40 hover:bg-gray-50/50' }}">
                            <input type="radio" wire:model.live="selectedPackageId" value="{{ $package->id }}" class="sr-only">
                            
                            <div>
                                <div class="flex items-start gap-3">
                                    @if($package->image_url)
                                        <img src="{{ $package->image_url }}" alt="{{ $package->name }}" class="object-cover rounded-xl border border-gray-200 shadow-2xs shrink-0 bg-white" style="width: 56px; height: 56px; max-width: 56px; max-height: 56px;" onerror="this.onerror=null; this.style.display='none';">
                                    @endif
                                    
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-2 mb-1">
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <h4 class="font-bold text-gray-900 text-base leading-snug">{{ $package->name }}</h4>
                                                @if($hasPromo)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-red-100 text-red-700 border border-red-200 uppercase tracking-wider">
                                                        PROMO -{{ $promo->getFormattedDiscount() }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="flex-shrink-0 text-primary transition-opacity {{ $selectedPackageId == $package->id ? 'opacity-100' : 'opacity-0' }}">
                                                <svg class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        
                                        @if($hasPromo)
                                            <div class="flex items-baseline gap-2 mt-2">
                                                <span class="text-xl font-extrabold text-red-600">Rp {{ number_format($promoPrice, 0, ',', '.') }}</span>
                                                <span class="text-xs text-gray-400 line-through">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                            </div>
                                        @else
                                            <div class="mt-2">
                                                <span class="text-xl font-bold text-primary">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>

                <!-- Package Details -->
                @if($selectedPackageId)
                    @php
                        $selectedPackage = \App\Models\Service\Package::with('activePromo')->find($selectedPackageId);
                    @endphp
                    @if($selectedPackage)
                        <div class="bg-gray-50/80 rounded-xl p-5 border border-gray-200/80 animate-fade-in-up">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-4">
                                @if($selectedPackage->image_url)
                                    <img src="{{ $selectedPackage->image_url }}" alt="{{ $selectedPackage->name }}" class="object-cover rounded-xl border border-gray-200 shadow-2xs shrink-0 bg-white" style="width: 80px; height: 80px; max-width: 80px; max-height: 80px;" onerror="this.onerror=null; this.style.display='none';">
                                @endif
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-gray-900 text-base mb-1">Detail {{ $selectedPackage->name }}</h4>
                                    @if($selectedPackage->description)
                                        <p class="text-sm text-gray-600 leading-snug">{{ $selectedPackage->description }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            @if(is_array($selectedPackage->features) && count($selectedPackage->features) > 0)
                                <ul class="space-y-2 border-t border-gray-200/60 pt-3">
                                    @foreach($selectedPackage->features as $feature)
                                        <li class="flex items-start gap-2 text-sm text-gray-700">
                                            <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endif
                @endif
            </div>
        @else
            <!-- Custom Videotron Settings -->
            @if($service->category->value === 'videotron')
                @php
                    $selectedSpec = $selectedSpecId ? \App\Models\Service\VideotronSpec::find($selectedSpecId) : null;
                @endphp
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-5">
                    <h3 class="text-lg font-bold text-gray-900">Ukuran & Spesifikasi Videotron</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Lebar Input -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Lebar (Meter) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   wire:model.live.debounce.300ms="videotronWidth" 
                                   step="0.5" 
                                   min="0.5" 
                                   placeholder="Contoh: 4" 
                                   class="w-full rounded-xl border border-gray-200 bg-gray-50/80 px-4 py-2.5 text-sm font-medium text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none">
                            @error('videotronWidth') 
                                <span class="text-xs text-red-500 mt-1.5 block font-medium">{{ $message }}</span> 
                            @enderror
                        </div>

                        <!-- Tinggi Input -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tinggi (Meter) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   wire:model.live.debounce.300ms="videotronHeight" 
                                   step="0.5" 
                                   min="0.5" 
                                   placeholder="Contoh: 3" 
                                   class="w-full rounded-xl border border-gray-200 bg-gray-50/80 px-4 py-2.5 text-sm font-medium text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none">
                            @error('videotronHeight') 
                                <span class="text-xs text-red-500 mt-1.5 block font-medium">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Select Tipe Panel -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Pilih Tipe / Spesifikasi Videotron
                        </label>
                        <select wire:model.live="selectedSpecId" 
                                class="w-full rounded-xl border border-gray-200 bg-gray-50/80 px-4 py-2.5 text-sm font-medium text-gray-900 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none cursor-pointer">
                            @foreach($this->videotronSpecs as $spec)
                                <option value="{{ $spec->id }}">
                                    {{ $spec->brand }} {{ $spec->model }} ({{ $spec->power_consumption_watt ?? 350 }} W/m²) — {{ ucfirst($spec->type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Selected Spec Details Card with Fixed Image & Badges -->
                    @if($selectedSpec)
                        <div class="p-4 bg-gray-50/80 rounded-xl border border-gray-200/80 flex flex-col sm:flex-row items-start sm:items-center gap-4 animate-fade-in-up w-full overflow-hidden">
                            @if($selectedSpec->image_url)
                                <img src="{{ $selectedSpec->image_url }}" alt="{{ $selectedSpec->brand }}" class="object-cover rounded-xl border border-gray-200 shadow-2xs shrink-0 bg-white" style="width: 96px; height: 96px; max-width: 96px; max-height: 96px;" onerror="this.onerror=null; this.style.display='none';">
                            @else
                                <div class="w-24 h-24 bg-white rounded-xl border border-gray-200 flex items-center justify-center text-primary/40 shrink-0 shadow-2xs">
                                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif

                            <div class="space-y-1.5 flex-1 min-w-0 w-full overflow-hidden">
                                <h4 class="font-bold text-gray-900 text-base leading-snug break-words">
                                    {{ $selectedSpec->brand }} {{ $selectedSpec->model }}
                                </h4>
                                <div class="flex items-center gap-1.5 flex-wrap text-xs max-w-full">
                                    <span class="px-2 py-0.5 rounded-md font-semibold bg-primary/10 text-primary border border-primary/20 text-[11px] whitespace-nowrap">
                                        ⚡ {{ $selectedSpec->power_consumption_watt ?? 350 }} W/m²
                                    </span>
                                    <span class="px-2 py-0.5 rounded-md font-semibold bg-amber-100/80 text-amber-800 border border-amber-200 text-[11px] whitespace-nowrap">
                                        🔄 {{ $selectedSpec->refresh_rate ?? 3840 }} Hz
                                    </span>
                                    <span class="px-2 py-0.5 rounded-md font-semibold bg-amber-50 text-amber-700 border border-amber-200 text-[11px] whitespace-nowrap">
                                        ☀️ {{ $selectedSpec->brightness }} nits
                                    </span>
                                    <span class="px-2 py-0.5 rounded-md font-semibold bg-gray-200/80 text-gray-700 text-[11px] whitespace-nowrap">
                                        {{ ucfirst($selectedSpec->type) }}
                                    </span>
                                </div>
                                @if($selectedSpec->description)
                                    <p class="text-xs text-gray-500 leading-snug pt-0.5 line-clamp-2 break-words">{{ $selectedSpec->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    <!-- Resolusi & Kebutuhan Daya Info -->
                    @if($this->resolution || $this->powerConsumption)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 animate-fade-in-up w-full">
                            @if($this->resolution)
                                <div class="bg-primary/5 rounded-xl p-3.5 sm:p-4 border border-primary/15 flex items-center justify-between min-w-0 w-full overflow-hidden">
                                    <div class="min-w-0 flex-1 pr-2">
                                        <span class="block text-[11px] sm:text-xs font-semibold text-gray-500 uppercase tracking-wider mb-0.5 truncate">Estimasi Resolusi (256 px/m)</span>
                                        <span class="text-sm sm:text-base font-extrabold text-primary truncate block">{{ $this->resolution->formatted }}</span>
                                    </div>
                                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg bg-primary/10 flex items-center justify-center text-primary shrink-0">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                        </svg>
                                    </div>
                                </div>
                            @endif

                            @if($this->powerConsumption)
                                <div class="bg-amber-500/5 rounded-xl p-3.5 sm:p-4 border border-amber-500/20 flex items-center justify-between min-w-0 w-full overflow-hidden">
                                    <div class="min-w-0 flex-1 pr-2">
                                        <span class="block text-[11px] sm:text-xs font-semibold text-gray-500 uppercase tracking-wider mb-0.5 truncate">Estimasi Listrik ({{ $this->powerConsumption['watts_per_m2'] }} W/m²)</span>
                                        <span class="text-sm sm:text-base font-extrabold text-amber-700 truncate block">{{ $this->powerConsumption['formatted'] }}</span>
                                    </div>
                                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-600 shrink-0">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        @endif

        <!-- Addons / Optional Items -->
        @if($service->addonItems->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Item Tambahan (Addons)</h3>
                <div class="space-y-3">
                    @foreach($service->addonItems as $addon)
                        <div class="flex items-center justify-between p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" 
                                       wire:click="toggleAddon('{{ $addon->id }}')" 
                                       @checked(isset($selectedAddons[$addon->id]) && $selectedAddons[$addon->id] > 0)
                                       class="rounded text-primary focus:ring-primary">
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $addon->name }}</h4>
                                    <p class="text-sm text-gray-500">+ Rp {{ number_format($addon->price, 0, ',', '.') }} / {{ $addon->unit }}</p>
                                </div>
                            </div>
                            
                            @if(isset($selectedAddons[$addon->id]) && $selectedAddons[$addon->id] > 0)
                                <div class="flex items-center gap-3 bg-white border border-gray-200 rounded-lg p-1">
                                    <button wire:click="decrementAddon('{{ $addon->id }}')" class="w-6 h-6 flex items-center justify-center rounded text-gray-500 hover:bg-gray-100">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                    </button>
                                    <span class="w-4 text-center text-sm font-medium">{{ $selectedAddons[$addon->id] }}</span>
                                    <button wire:click="incrementAddon('{{ $addon->id }}')" class="w-6 h-6 flex items-center justify-center rounded text-gray-500 hover:bg-gray-100">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        
    </div>

    <!-- Order Summary Sidebar -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-xl shadow-primary/5 border border-gray-100 p-6 sticky top-24">
            <h3 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">Ringkasan Pesanan</h3>
            
            <div class="space-y-4 mb-6">
                <!-- Base Service/Package -->
                @php
                    $summaryPackage = $bookingType === 'package' && $selectedPackageId
                        ? \App\Models\Service\Package::with('activePromo')->find($selectedPackageId)
                        : null;
                    $summaryPromo   = $summaryPackage?->activePromo;
                    $summaryHasPromo = $summaryPromo && $summaryPromo->isCurrentlyActive();
                @endphp
                <div class="flex justify-between items-start text-sm">
                    <span class="text-gray-700 font-semibold pr-4">
                        @if($bookingType === 'package')
                            {{ $summaryPackage?->name ?? 'Belum Memilih Paket' }}
                        @elseif($service->category->value === 'videotron')
                            Sewa Videotron ({{ $videotronWidth }}m x {{ $videotronHeight }}m)
                        @else
                            Sewa {{ $service->name }} (Custom)
                        @endif
                    </span>
                    <span class="font-bold {{ $summaryHasPromo ? 'text-gray-400 line-through' : 'text-gray-900' }} whitespace-nowrap">
                        @if($bookingType === 'package' && $selectedPackageId && $summaryPackage)
                            Rp {{ number_format($summaryPackage->price, 0, ',', '.') }}
                        @elseif($service->category->value === 'videotron' && $selectedSpecId)
                            @php
                                $w = (float) ($videotronWidth ?: 0);
                                $h = (float) ($videotronHeight ?: 0);
                                $spec = \App\Models\Service\VideotronSpec::find($selectedSpecId);
                                $videotronBasePrice = ($spec && $w > 0 && $h > 0) ? ($spec->price_per_m2 * $w * $h) : 0;
                            @endphp
                            Rp {{ number_format($videotronBasePrice, 0, ',', '.') }}
                        @else
                            Rp 0
                        @endif
                    </span>
                </div>

                <!-- Videotron Tech Specs Badge in Sidebar -->
                @if($service->category->value === 'videotron' && ($this->resolution || $this->powerConsumption))
                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-200/80 text-xs space-y-1.5">
                        @if($this->resolution)
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 font-medium">Estimasi Resolusi:</span>
                                <span class="font-bold text-primary">{{ $this->resolution->formatted }}</span>
                            </div>
                        @endif
                        @if($this->powerConsumption)
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 font-medium">Estimasi Listrik:</span>
                                <span class="font-bold text-amber-700">{{ $this->powerConsumption['formatted'] }}</span>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Promo Discount Box --}}
                @if($summaryHasPromo)
                    <div class="p-3 bg-red-50/90 rounded-xl border border-red-100 text-xs space-y-1">
                        <div class="flex items-center justify-between font-semibold text-red-700">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <span>Diskon Promo</span>
                            </span>
                            <span class="font-extrabold text-red-600 text-sm">- {{ $summaryPromo->getFormattedDiscount() }}</span>
                        </div>
                        <p class="text-red-500 text-[11px] font-medium truncate" title="{{ $summaryPromo->name }}">
                            {{ $summaryPromo->name }}
                        </p>
                    </div>
                @endif

                <!-- Addons in Summary -->
                @foreach($this->addonsList as $addonDto)
                    @php
                        $item = \App\Models\Service\AddonItem::find($addonDto->addonId);
                    @endphp
                    @if($item)
                    <div class="flex justify-between items-start text-sm mt-2">
                        <span class="text-gray-500 pr-4">
                            + {{ $item->name }} <span class="text-xs text-gray-400">(x{{ $addonDto->quantity }})</span>
                        </span>
                        <span class="font-medium text-gray-700 whitespace-nowrap">
                            Rp {{ number_format($item->price * $addonDto->quantity, 0, ',', '.') }}
                        </span>
                    </div>
                    @endif
                @endforeach
            </div>
            
            <div class="border-t border-gray-100 pt-4 mb-6">
                <div class="flex flex-col gap-1">
                    <span class="text-gray-500 text-sm font-medium">Total Estimasi</span>
                    <span class="text-3xl font-extrabold text-primary tracking-tight">Rp {{ number_format($this->totalPrice, 0, ',', '.') }}</span>
                </div>
                <p class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    Harga belum termasuk transport & pajak
                </p>
            </div>
            
            <div class="space-y-4 mb-8 bg-gray-50/50 rounded-xl p-4 border border-gray-100">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wider">Tanggal Event <span class="text-red-500">*</span></label>
                    <input type="date" wire:model.live="eventDate" class="w-full rounded-lg border-gray-200 bg-white focus:border-primary focus:ring-primary focus:ring-2 focus:ring-opacity-20 shadow-sm text-sm transition-all py-2.5 px-3">
                    @error('eventDate') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wider">Lokasi Event <span class="text-red-500">*</span></label>
                    <input type="text" wire:model.live="eventLocation" placeholder="Contoh: Gedung A, Surabaya" class="w-full rounded-lg border-gray-200 bg-white focus:border-primary focus:ring-primary focus:ring-2 focus:ring-opacity-20 shadow-sm text-sm transition-all py-2.5 px-3">
                    @error('eventLocation') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <button wire:click="orderNow" class="w-full bg-[#25D366] hover:bg-[#128C7E] text-white flex justify-center items-center gap-2.5 py-3.5 px-4 rounded-xl shadow-lg shadow-green-500/30 transition-all hover:scale-[1.02] hover:shadow-xl font-bold">
                <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
                <span>Kirim Pesan WhatsApp</span>
            </button>
        </div>
    </div>
</div>
