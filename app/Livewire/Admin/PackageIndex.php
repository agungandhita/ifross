<?php

namespace App\Livewire\Admin;

use App\DTOs\Package\SavePackageDTO;
use App\Livewire\Forms\PackageForm;
use App\Services\Package\PackageServiceInterface;
use App\Services\Service\ServiceServiceInterface;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PackageIndex extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';
    public string $serviceFilter = '';
    
    // Modal state
    public bool $showModal = false;
    public bool $isEdit = false;
    
    public PackageForm $form;
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingServiceFilter()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->form->clear();
        $this->form->sort_order = 0; 
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function edit($id, PackageServiceInterface $packageService)
    {
        $this->form->clear();
        
        $package = $packageService->getById($id);
        $this->form->setPackage($package);
        
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function save(PackageServiceInterface $packageService)
    {
        $this->form->validate();

        $imagePath = $this->form->existingImage;

        if ($this->form->image) {
            $path = $this->form->image->store('packages', 'public');
            $imagePath = '/storage/' . $path;
        }

        // Parse features
        $featuresArray = [];
        if (trim($this->form->features)) {
            $featuresArray = array_values(array_filter(array_map('trim', explode("\n", $this->form->features))));
        }

        // Parse metadata
        $metaArray = [];
        if (trim($this->form->metadata)) {
            $lines = array_filter(array_map('trim', explode("\n", $this->form->metadata)));
            foreach ($lines as $line) {
                if (str_contains($line, ':')) {
                    [$key, $value] = explode(':', $line, 2);
                    $metaArray[trim($key)] = trim($value);
                }
            }
        }

        $dto = new SavePackageDTO(
            id: $this->form->packageId,
            service_id: $this->form->service_id,
            name: $this->form->name,
            price: $this->form->price,
            description: $this->form->description,
            features: empty($featuresArray) ? null : $featuresArray,
            metadata: empty($metaArray) ? null : $metaArray,
            imagePath: $imagePath,
            sort_order: $this->form->sort_order,
            is_active: $this->form->is_active,
            is_featured: $this->form->is_featured,
        );

        $packageService->save($dto);

        $this->showModal = false;
        $this->form->clear();
        
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Paket Layanan berhasil disimpan!'
        ]);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data ini akan dihapus permanen!',
            'id' => $id,
            'action' => 'deletePackage'
        ]);
    }

    #[On('deletePackage')]
    public function delete($id, PackageServiceInterface $packageService)
    {
        $packageService->delete($id);
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Paket Layanan berhasil dihapus!'
        ]);
    }

    public function render(
        PackageServiceInterface $packageService,
        ServiceServiceInterface $serviceService
    ): \Illuminate\View\View {
        return view('livewire.admin.package-index', [
            'packages' => $packageService->getPaginated($this->search, $this->serviceFilter, 10),
            'services' => $serviceService->getAllForAdmin(),
        ])->layout('components.admin-layout', ['title' => 'Kelola Paket Layanan']);
    }
}
