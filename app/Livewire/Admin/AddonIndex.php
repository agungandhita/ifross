<?php

namespace App\Livewire\Admin;

use App\DTOs\Addon\SaveAddonDTO;
use App\Livewire\Forms\AddonForm;
use App\Services\Addon\AddonServiceInterface;
use App\Services\Service\ServiceServiceInterface;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class AddonIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $serviceFilter = '';
    
    // Modal state
    public bool $showModal = false;
    public bool $isEdit = false;
    
    public AddonForm $form;
    
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
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function edit($id, AddonServiceInterface $addonService)
    {
        $this->form->clear();
        
        $addon = $addonService->getById($id);
        $this->form->setAddon($addon);
        
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function save(AddonServiceInterface $addonService)
    {
        $this->form->validate();

        $dto = new SaveAddonDTO(
            id: $this->form->addonId,
            service_id: $this->form->service_id,
            name: $this->form->name,
            price: $this->form->price,
            unit: $this->form->unit,
            description: $this->form->description ?: null,
            is_active: $this->form->is_active,
            sort_order: $this->form->sort_order,
        );

        $addonService->save($dto);

        $this->showModal = false;
        $this->form->clear();
        
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Item Tambahan berhasil disimpan!'
        ]);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data ini akan dihapus permanen!',
            'id' => $id,
            'action' => 'deleteAddon'
        ]);
    }

    #[On('deleteAddon')]
    public function delete($id, AddonServiceInterface $addonService)
    {
        $addonService->delete($id);
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Item Tambahan berhasil dihapus!'
        ]);
    }

    public function render(
        AddonServiceInterface $addonService,
        ServiceServiceInterface $serviceService
    ): \Illuminate\View\View {
        return view('livewire.admin.addon-index', [
            'addons'   => $addonService->getPaginated($this->search, $this->serviceFilter, 15),
            'services' => $serviceService->getAllForAdmin(),
        ])->layout('components.admin-layout', ['title' => 'Kelola Item Tambahan']);
    }
}
