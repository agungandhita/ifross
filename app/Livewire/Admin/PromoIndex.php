<?php

namespace App\Livewire\Admin;

use App\DTOs\Promo\SavePromoDTO;
use App\Livewire\Forms\PromoForm;
use App\Services\Package\PackageServiceInterface;
use App\Services\Promo\PromoServiceInterface;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PromoIndex extends Component
{
    use WithPagination;

    public string $search       = '';
    public string $packageFilter = '';

    public bool $showModal = false;
    public bool $isEdit    = false;

    public PromoForm $form;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPackageFilter(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->form->clear();
        $this->isEdit    = false;
        $this->showModal = true;
    }

    public function edit(string $id, PromoServiceInterface $promoService): void
    {
        $this->form->clear();
        $promo = $promoService->getById($id);
        $this->form->setPromo($promo);
        $this->isEdit    = true;
        $this->showModal = true;
    }

    public function save(PromoServiceInterface $promoService): void
    {
        $this->form->validate();

        $dto = new SavePromoDTO(
            id:             $this->form->promoId,
            package_id:     $this->form->package_id,
            name:           $this->form->name,
            description:    $this->form->description ?: null,
            discount_type:  $this->form->discount_type,
            discount_value: (float) $this->form->discount_value,
            starts_at:      $this->form->starts_at ?: null,
            ends_at:        $this->form->ends_at ?: null,
            is_active:      $this->form->is_active,
        );

        $promoService->save($dto);

        $this->showModal = false;
        $this->form->clear();

        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text'  => 'Data promo berhasil disimpan!',
        ]);
    }

    public function confirmDelete(string $id): void
    {
        $this->dispatch('swal:confirm', [
            'type'   => 'warning',
            'title'  => 'Apakah Anda yakin?',
            'text'   => 'Promo ini akan dihapus permanen!',
            'id'     => $id,
            'action' => 'deletePromo',
        ]);
    }

    #[On('deletePromo')]
    public function delete(string $id, PromoServiceInterface $promoService): void
    {
        $promoService->delete($id);
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text'  => 'Promo berhasil dihapus!',
        ]);
    }

    public function render(
        PromoServiceInterface $promoService,
        PackageServiceInterface $packageService,
    ): \Illuminate\View\View {
        return view('livewire.admin.promo-index', [
            'promos'   => $promoService->getPaginated($this->search, $this->packageFilter, 10),
            'packages' => $packageService->getPaginated('', '', 500),
        ])->layout('components.admin-layout', ['title' => 'Kelola Promo']);
    }
}
