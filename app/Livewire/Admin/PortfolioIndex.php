<?php

namespace App\Livewire\Admin;

use App\DTOs\Portfolio\SavePortfolioDTO;
use App\Enums\ServiceCategory;
use App\Livewire\Forms\PortfolioForm;
use App\Services\Portfolio\PortfolioServiceInterface;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PortfolioIndex extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';
    public string $categoryFilter = '';
    
    // Modal state
    public bool $showModal = false;
    public bool $isEdit = false;
    
    public PortfolioForm $form;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->form->clear();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function edit($id, PortfolioServiceInterface $portfolioService)
    {
        $this->form->clear();
        
        $portfolio = $portfolioService->getById($id);
        $this->form->setPortfolio($portfolio);
        
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function save(PortfolioServiceInterface $portfolioService)
    {
        $this->form->validate();

        $mediaPaths = $this->form->images;

        // Handle file upload if any
        if ($this->form->newMedia) {
            $path = $this->form->newMedia->store('portfolios', 'public');
            $mediaPaths[] = '/storage/' . $path;
            
            // Auto set thumbnail if none
            if (empty($this->form->thumbnail)) {
                $this->form->thumbnail = '/storage/' . $path;
            }
        }
        
        $dto = new SavePortfolioDTO(
            id: $this->form->portfolioId,
            title: $this->form->title,
            category: $this->form->category,
            description: $this->form->description ?: null,
            location: $this->form->location ?: null,
            event_date: $this->form->event_date ?: null,
            client_name: $this->form->client_name ?: null,
            images: empty($mediaPaths) ? null : $mediaPaths,
            thumbnail: $this->form->thumbnail ?: null,
            video_url: $this->form->video_url ?: null,
            is_active: $this->form->is_active,
            is_featured: $this->form->is_featured,
            sort_order: $this->form->sort_order,
        );

        $portfolioService->save($dto);

        $this->showModal = false;
        $this->form->clear();
        
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Portofolio berhasil disimpan!'
        ]);
    }

    public function removeMedia($index)
    {
        unset($this->form->images[$index]);
        $this->form->images = array_values($this->form->images);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data ini akan dihapus permanen!',
            'id' => $id,
            'action' => 'deletePortfolio'
        ]);
    }

    #[On('deletePortfolio')]
    public function delete($id, PortfolioServiceInterface $portfolioService)
    {
        $portfolioService->delete($id);
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Portofolio berhasil dihapus!'
        ]);
    }

    public function render(PortfolioServiceInterface $portfolioService)
    {
        return view('livewire.admin.portfolio-index', [
            'portfolios' => $portfolioService->getPaginated($this->search, $this->categoryFilter, 10),
            'categories' => ServiceCategory::cases()
        ])->layout('components.admin-layout', ['title' => 'Kelola Portofolio']);
    }
}
