<?php

namespace App\Livewire\Admin;

use App\Services\Dashboard\DashboardServiceInterface;
use Livewire\Component;

class Dashboard extends Component
{
    public function render(DashboardServiceInterface $dashboardService): \Illuminate\View\View
    {
        return view('livewire.admin.dashboard', [
            'stats'            => $dashboardService->getStats(),
            'recentPortfolios' => $dashboardService->getRecentPortfolios(5),
        ])->layout('components.admin-layout', ['title' => 'Dashboard Admin']);
    }
}
