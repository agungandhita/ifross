<?php

namespace App\Livewire\Public;

use App\Enums\ServiceCategory;
use App\Models\Portfolio\Portfolio;
use Livewire\Component;
use Livewire\WithPagination;

class PortfolioGallery extends Component
{
    use WithPagination;

    public string $category = 'all';

    protected $queryString = [
        'category' => ['except' => 'all']
    ];

    public function setCategory($category)
    {
        $this->category = $category;
        $this->resetPage();
    }

    public function render()
    {
        $query = Portfolio::active()->ordered();

        if ($this->category !== 'all') {
            $query->where('category', $this->category);
        }

        $portfolios = $query->paginate(9);
        $categories = ServiceCategory::cases();

        return view('livewire.public.portfolio-gallery', compact('portfolios', 'categories'));
    }
}
