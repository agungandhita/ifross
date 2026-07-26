<?php

namespace App\Services\Dashboard;

use App\DTOs\Dashboard\DashboardStatsDTO;
use Illuminate\Database\Eloquent\Collection;

interface DashboardServiceInterface
{
    /**
     * Ambil statistik ringkasan untuk ditampilkan di dashboard admin.
     */
    public function getStats(): DashboardStatsDTO;

    /**
     * Ambil N portfolio terbaru untuk tabel dashboard.
     *
     * @return Collection<int, \App\Models\Portfolio\Portfolio>
     */
    public function getRecentPortfolios(int $limit = 5): Collection;
}
