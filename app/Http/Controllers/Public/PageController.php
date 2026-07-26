<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Portfolio\Portfolio;
use App\Services\Page\PageServiceInterface;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(
        private readonly PageServiceInterface $pageService,
    ) {}

    /**
     * Tampilkan halaman Beranda (Home).
     */
    public function home(): View
    {
        return view('pages.public.home', $this->pageService->getHomeData());
    }

    /**
     * Tampilkan halaman Daftar Layanan.
     */
    public function services(): View
    {
        return view('pages.public.services', $this->pageService->getServicesData());
    }

    /**
     * Tampilkan halaman Daftar Portofolio.
     */
    public function portfolios(): View
    {
        // Portofolio di-handle oleh Livewire component untuk fitur filter
        return view('pages.public.portfolios');
    }

    /**
     * Tampilkan halaman Detail Portofolio (Halaman Berita & Case Study).
     */
    public function portfolioDetail(Portfolio $portfolio): View
    {
        abort_if(! $portfolio->is_active, 404);

        $portfolio->load('testimonials');
        $relatedPortfolios = Portfolio::active()
            ->where('id', '!=', $portfolio->id)
            ->where('category', $portfolio->category->value)
            ->latest('event_date')
            ->take(3)
            ->get();

        if ($relatedPortfolios->isEmpty()) {
            $relatedPortfolios = Portfolio::active()
                ->where('id', '!=', $portfolio->id)
                ->latest('event_date')
                ->take(3)
                ->get();
        }

        return view('pages.public.portfolio-detail', compact('portfolio', 'relatedPortfolios'));
    }
}
