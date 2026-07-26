<?php

namespace App\Livewire\Admin;

use App\DTOs\Testimonial\SaveTestimonialDTO;
use App\Livewire\Forms\TestimonialForm;
use App\Services\Portfolio\PortfolioServiceInterface;
use App\Services\Testimonial\TestimonialServiceInterface;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class TestimonialIndex extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';
    
    // Modal state
    public bool $showModal = false;
    public bool $isEdit = false;
    
    public TestimonialForm $form;
    
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

    public function edit($id, TestimonialServiceInterface $testimonialService)
    {
        $this->form->clear();
        
        $testimonial = $testimonialService->getById($id);
        $this->form->setTestimonial($testimonial);
        
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function save(TestimonialServiceInterface $testimonialService)
    {
        $this->form->validate();

        $photoPath = $this->form->existingPhoto;

        if ($this->form->photo) {
            $path = $this->form->photo->store('testimonials', 'public');
            $photoPath = '/storage/' . $path;
        }

        $dto = new SaveTestimonialDTO(
            id: $this->form->testimonialId,
            portfolio_id: $this->form->portfolio_id ?: null,
            name: $this->form->name,
            position: $this->form->position ?: null,
            rating: $this->form->rating,
            review: $this->form->review,
            photoPath: $photoPath,
            is_active: $this->form->is_active,
            sort_order: $this->form->sort_order,
        );

        $testimonialService->save($dto);

        $this->showModal = false;
        $this->form->clear();
        
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Testimoni berhasil disimpan!'
        ]);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data ini akan dihapus permanen!',
            'id' => $id,
            'action' => 'deleteTestimonial'
        ]);
    }

    #[On('deleteTestimonial')]
    public function delete($id, TestimonialServiceInterface $testimonialService)
    {
        $testimonialService->delete($id);
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Testimoni berhasil dihapus!'
        ]);
    }

    public function removePhoto()
    {
        $this->form->existingPhoto = null;
        $this->form->photo = null;
    }

    public function render(
        TestimonialServiceInterface $testimonialService,
        PortfolioServiceInterface $portfolioService
    ): \Illuminate\View\View {
        return view('livewire.admin.testimonial-index', [
            'testimonials' => $testimonialService->getPaginated($this->search, 10),
            'portfolios'   => $portfolioService->getAllForDropdown(),
        ])->layout('components.admin-layout', ['title' => 'Kelola Testimoni']);
    }
}
