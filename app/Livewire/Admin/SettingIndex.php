<?php

namespace App\Livewire\Admin;

use App\DTOs\Setting\SaveSettingDTO;
use App\Livewire\Forms\SettingForm;
use App\Services\Setting\SettingServiceInterface;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SettingIndex extends Component
{
    use WithPagination;

    public string $search = '';
    
    // Modal state
    public bool $showModal = false;
    public bool $isEdit    = false;
    
    public SettingForm $form;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->form->clear();
        $this->isEdit    = false;
        $this->showModal = true;
    }

    public function edit(string $key, SettingServiceInterface $settingService): void
    {
        $this->form->clear();
        
        $setting = $settingService->getByKey($key);
        $this->form->setSetting($setting);
        
        $this->isEdit    = true;
        $this->showModal = true;
    }

    public function save(SettingServiceInterface $settingService): void
    {
        $this->form->validate();

        $dto = new SaveSettingDTO(
            originalKey: $this->form->originalKey,
            key: $this->form->key,
            value: $this->form->value,
            type: $this->form->type,
            label: $this->form->label,
            group: $this->form->group,
            description: $this->form->description ?: null,
        );

        $settingService->save($dto);

        $this->showModal = false;
        $this->form->clear();
        
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Setting berhasil disimpan!'
        ]);
    }

    public function confirmDelete(string $key)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data ini akan dihapus permanen!',
            'id' => $key,
            'action' => 'deleteSetting'
        ]);
    }

    #[On('deleteSetting')]
    public function delete(string $id, SettingServiceInterface $settingService): void
    {
        $settingService->delete($id);
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Setting berhasil dihapus!'
        ]);
    }

    public function render(SettingServiceInterface $settingService): \Illuminate\View\View
    {
        return view('livewire.admin.setting-index', [
            'settings' => $settingService->getPaginated($this->search, 10)
        ])->layout('components.admin-layout', ['title' => 'Pengaturan Situs']);
    }
}
