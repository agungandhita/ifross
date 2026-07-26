<?php

namespace App\Livewire\Public;

use App\DTOs\Booking\BookingSummaryDTO;
use App\DTOs\Pricing\AddonSelectionDTO;
use App\Enums\BookingType;
use App\Enums\ServiceCategory;
use App\Models\Service\AddonItem;
use App\Models\Service\Package;
use App\Models\Service\Service;
use App\Models\Service\VideotronSpec;
use App\Services\Pricing\PricingServiceInterface;
use App\Services\Whatsapp\WhatsappMessageBuilderServiceInterface;
use Livewire\Component;

class ServiceBooking extends Component
{
    public Service $service;
    
    public string $bookingType = 'package'; // 'package' or 'custom'
    
    // Package mode state
    public ?string $selectedPackageId = null;
    
    // Custom mode state (Videotron)
    // Sengaja tidak ada type hint agar Livewire bisa menerima string dari input number,
    // normalisasi dilakukan di lifecycle hooks di bawah.
    public mixed $videotronWidth  = 4.0;
    public mixed $videotronHeight = 3.0;
    public ?string $selectedSpecId = null;
    
    // Addons state
    public array $selectedAddons = []; // [addon_id => quantity]
    
    // Event Details
    public ?string $eventDate = null;
    public ?string $eventLocation = null;
    
    public function mount(Service $service)
    {
        // Unset relation cached from controller to force reload with activePromo
        $service->unsetRelation('packages');
        $this->service = $service->load([
            'packages' => fn($q) => $q->active()->with('activePromo'),
            'addonItems' => fn($q) => $q->active(),
        ]);
        
        // Auto-select first package if available
        if ($this->service->packages->count() > 0) {
            $this->selectedPackageId = $this->service->packages->first()->id;
        }
        
        // Auto-select first videotron spec if videotron category
        if ($this->service->category === ServiceCategory::Videotron) {
            $firstSpec = VideotronSpec::active()->first();
            if ($firstSpec) {
                $this->selectedSpecId = $firstSpec->id;
            }
        }
        
        // Initialize addons array
        foreach ($this->service->addonItems as $addon) {
            $this->selectedAddons[$addon->id] = 0;
        }
    }
    
    // ─── Addon actions ────────────────────────────────────────────────────────

    public function toggleAddon($addonId)
    {
        if (isset($this->selectedAddons[$addonId]) && $this->selectedAddons[$addonId] > 0) {
            $this->selectedAddons[$addonId] = 0;
        } else {
            $this->selectedAddons[$addonId] = 1;
        }
    }
    
    public function incrementAddon($addonId)
    {
        $this->selectedAddons[$addonId] = ($this->selectedAddons[$addonId] ?? 0) + 1;
    }
    
    public function decrementAddon($addonId)
    {
        if (isset($this->selectedAddons[$addonId]) && $this->selectedAddons[$addonId] > 0) {
            $this->selectedAddons[$addonId]--;
        }
    }

    public function getAddonsListProperty()
    {
        $dtos = [];
        foreach ($this->selectedAddons as $addonId => $quantity) {
            if ($quantity > 0) {
                $dtos[] = new AddonSelectionDTO($addonId, $quantity);
            }
        }
        return $dtos;
    }

    public function getTotalPriceProperty(PricingServiceInterface $pricingService)
    {
        $addons = $this->addonsList;
        
        if ($this->bookingType === 'package') {
            if (!$this->selectedPackageId) return 0;
            $package = $this->service->packages->firstWhere('id', $this->selectedPackageId);
            if (!$package) return 0;
            
            // Terapkan promo aktif jika ada
            $activePromo = $package->activePromo;
            $baseTotal   = $pricingService->calculatePackagePrice($package, $addons);

            if ($activePromo && $activePromo->isCurrentlyActive()) {
                return $activePromo->getDiscountedPrice($package->price) + ($baseTotal - $package->price);
            }

            return $baseTotal;
        } else {
            if ($this->service->category === ServiceCategory::Videotron) {
                if (!$this->selectedSpecId) return 0;
                $spec = VideotronSpec::find($this->selectedSpecId);
                if (!$spec) return 0;

                // Pastikan dimensi valid sebelum dikirim ke service agar tidak throw exception
                $w = (float) ($this->videotronWidth ?: 0);
                $h = (float) ($this->videotronHeight ?: 0);
                if ($w <= 0 || $h <= 0) return 0;

                return $pricingService->calculateCustomVideotronPrice($w, $h, $spec, $addons);
            }
            
            return $this->getAddonsSum();
        }
    }
    
    public function getVideotronSpecsProperty()
    {
        return VideotronSpec::active()->get();
    }
    
    public function getResolutionProperty(PricingServiceInterface $pricingService)
    {
        if ($this->service->category !== ServiceCategory::Videotron || !$this->selectedSpecId) {
            return null;
        }
        
        $spec = VideotronSpec::find($this->selectedSpecId);
        if (!$spec) return null;
        
        $w = (float) ($this->videotronWidth ?: 0);
        $h = (float) ($this->videotronHeight ?: 0);
        if ($w <= 0 || $h <= 0) return null;

        return $pricingService->calculateResolution($w, $h, $spec);
    }

    public function getPowerConsumptionProperty()
    {
        if ($this->service->category !== ServiceCategory::Videotron || !$this->selectedSpecId) {
            return null;
        }
        
        $spec = VideotronSpec::find($this->selectedSpecId);
        if (!$spec) return null;
        
        $w = (float) ($this->videotronWidth ?: 0);
        $h = (float) ($this->videotronHeight ?: 0);
        if ($w <= 0 || $h <= 0) return null;

        $area = $w * $h;
        $wattsPerM2 = $spec->power_consumption_watt ?? 350;
        $totalWatts = (int) round($area * $wattsPerM2);
        $totalKW = round($totalWatts / 1000, 2);

        return [
            'watts'        => $totalWatts,
            'kw'           => $totalKW,
            'area'         => $area,
            'watts_per_m2' => $wattsPerM2,
            'formatted'    => number_format($totalWatts, 0, ',', '.') . ' Watt (' . $totalKW . ' kW)',
        ];
    }
    
    private function getAddonsSum()
    {
        $total = 0;
        foreach ($this->addonsList as $addonDto) {
            $item = $this->service->addonItems->firstWhere('id', $addonDto->addonId);
            if ($item) {
                $total += $item->price * $addonDto->quantity;
            }
        }
        return $total;
    }
    
    public function orderNow(WhatsappMessageBuilderServiceInterface $waService)
    {
        $rules = [
            'eventDate' => 'required|date',
            'eventLocation' => 'required|string|max:255',
        ];

        $messages = [
            'eventDate.required' => 'Tanggal event wajib diisi.',
            'eventLocation.required' => 'Lokasi event wajib diisi.',
            'videotronWidth.required' => 'Lebar videotron wajib diisi.',
            'videotronWidth.gt' => 'Lebar videotron harus lebih dari 0.',
            'videotronHeight.required' => 'Tinggi videotron wajib diisi.',
            'videotronHeight.gt' => 'Tinggi videotron harus lebih dari 0.',
        ];

        if ($this->bookingType === 'custom' && $this->service->category === ServiceCategory::Videotron) {
            $rules['videotronWidth'] = 'required|numeric|gt:0';
            $rules['videotronHeight'] = 'required|numeric|gt:0';
        }

        $this->validate($rules, $messages);

        $items = [];
        $packageName = 'Custom Order';
        $bType = BookingType::Custom;
        
        if ($this->bookingType === 'package') {
            $package = $this->service->packages->firstWhere('id', $this->selectedPackageId);
            $packageName = $package ? $package->name : 'Paket Tidak Diketahui';
            $bType = BookingType::Package;
        } elseif ($this->service->category === ServiceCategory::Videotron) {
            $spec = VideotronSpec::find($this->selectedSpecId);
            $specName = $spec ? $spec->brand . ' ' . $spec->model : '';
            $packageName = "Sewa Videotron {$this->videotronWidth}m x {$this->videotronHeight}m ({$specName})";
        }
        
        foreach ($this->addonsList as $addonDto) {
            $item = $this->service->addonItems->firstWhere('id', $addonDto->addonId);
            if ($item) {
                $items[] = [
                    'name' => $item->name,
                    'qty' => $addonDto->quantity,
                    'unit_price' => $item->price,
                    'subtotal' => $item->price * $addonDto->quantity
                ];
            }
        }
        
        $summary = new BookingSummaryDTO(
            serviceCategory: $this->service->category->label(),
            bookingType: $bType->value,
            packageName: $packageName,
            totalPrice: $this->totalPrice,
            items: $items,
            videotronWidth: $this->service->category === ServiceCategory::Videotron ? (string) $this->videotronWidth : null,
            videotronHeight: $this->service->category === ServiceCategory::Videotron ? (string) $this->videotronHeight : null,
            videotronResolution: $this->resolution?->formatted ?? null,
            videotronPowerConsumption: $this->powerConsumption['formatted'] ?? null,
            videotronSpecName: isset($specName) ? $specName : null,
            eventDate: date('d M Y', strtotime($this->eventDate)),
            eventLocation: $this->eventLocation,
        );
        
        $message = $waService->buildMessage($summary);
        
        // Use default number or from settings
        $whatsappNumber = \App\Models\Site\SiteSetting::get('whatsapp_number', '6281259956419');
        $url = $waService->generateWhatsappUrl($whatsappNumber, $message);
        
        return $this->redirect($url);
    }

    public function render()
    {
        return view('livewire.public.service-booking');
    }
}
