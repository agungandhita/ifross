<?php

namespace App\Livewire\Admin;

use App\DTOs\VideotronSpec\SaveVideotronSpecDTO;
use App\Livewire\Forms\VideotronForm;
use App\Services\VideotronSpec\VideotronSpecServiceInterface;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class VideotronIndex extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';
    
    // Modal state
    public bool $showModal = false;
    public bool $isEdit = false;
    
    public VideotronForm $form;
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->form->clear();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function edit($id, VideotronSpecServiceInterface $videotronService)
    {
        $this->form->clear();
        
        $spec = $videotronService->getById($id);
        $this->form->setSpec($spec);
        
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function save(VideotronSpecServiceInterface $videotronService)
    {
        $this->form->validate();

        $imagePath = $this->form->existing_image;
        if ($this->form->image) {
            $imagePath = $this->form->image->store('videotrons', 'public');
        }

        $dto = new SaveVideotronSpecDTO(
            id:               $this->form->specId,
            brand:            $this->form->brand,
            model:            $this->form->model ?: null,
            power_consumption_watt: (int) ($this->form->power_consumption_watt ?: 350),
            brightness:       (int) $this->form->brightness,
            refresh_rate:     (int) ($this->form->refresh_rate ?: 3840),
            panel_width_cm:   (float) $this->form->panel_width_cm,
            panel_height_cm:  (float) $this->form->panel_height_cm,
            pixels_per_meter: (int) ($this->form->pixels_per_meter ?: 256),
            price_per_m2:     (float) $this->form->price_per_m2,
            type:             $this->form->type,
            image:            $imagePath,
            description:      $this->form->description ?: null,
            is_active:        $this->form->is_active,
        );

        $videotronService->save($dto);

        $this->showModal = false;
        $this->form->clear();
        
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Spesifikasi Videotron berhasil disimpan!'
        ]);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data ini akan dihapus permanen!',
            'id' => $id,
            'action' => 'deleteVideotron'
        ]);
    }

    #[On('deleteVideotron')]
    public function delete($id, VideotronSpecServiceInterface $videotronService)
    {
        $videotronService->delete($id);
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Spesifikasi berhasil dihapus!'
        ]);
    }

    public function render(VideotronSpecServiceInterface $videotronService)
    {
        return view('livewire.admin.videotron-index', [
            'specs' => $videotronService->getPaginated($this->search, 10)
        ])->layout('components.admin-layout', ['title' => 'Kelola Spesifikasi Videotron']);
    }
}
