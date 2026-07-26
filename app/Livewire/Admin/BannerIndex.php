<?php

namespace App\Livewire\Admin;

use App\DTOs\Banner\SaveBannerDTO;
use App\Livewire\Forms\BannerForm;
use App\Models\Site\Banner;
use App\Services\Banner\BannerServiceInterface;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BannerIndex extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';

    // Modal state
    public bool $showModal = false;
    public bool $isEdit    = false;

    public BannerForm $form;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->form->clear();
        $this->isEdit     = false;
        $this->showModal  = true;
    }

    public function edit(string $id, BannerServiceInterface $bannerService): void
    {
        $this->form->clear();

        $banner = $bannerService->getById($id);

        $this->form->setBanner($banner);

        $this->isEdit    = true;
        $this->showModal = true;
    }

    public function save(BannerServiceInterface $bannerService): void
    {
        $this->form->validate();

        $imagePath = $this->form->existingImage;

        if ($this->form->image) {
            $path      = $this->form->image->store('banners', 'public');
            $imagePath = '/storage/' . $path;
        }

        $dto = new SaveBannerDTO(
            id: $this->form->bannerId,
            title: $this->form->title,
            subtitle: $this->form->subtitle ?: null,
            description: $this->form->description ?: null,
            badge_text: $this->form->badge_text ?: null,
            cta_text: $this->form->cta_text ?: null,
            cta_url: $this->form->cta_url ?: null,
            sort_order: $this->form->sort_order,
            imagePath: $imagePath,
            is_active: $this->form->is_active,
        );

        $bannerService->save($dto);

        $this->showModal = false;
        $this->form->clear();

        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Banner berhasil disimpan!'
        ]);
    }

    #[On('deleteBanner')]
    public function delete(string $id, BannerServiceInterface $bannerService): void
    {
        $bannerService->delete($id);
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Banner berhasil dihapus!'
        ]);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data ini akan dihapus permanen!',
            'id' => $id,
            'action' => 'deleteBanner'
        ]);
    }

    public function render(BannerServiceInterface $bannerService): \Illuminate\View\View
    {
        return view('livewire.admin.banner-index', [
            'banners' => $bannerService->getPaginated($this->search, 10)
        ])->layout('components.admin-layout', ['title' => 'Kelola Banner']);
    }
}
