<?php

namespace App\Services\Service;

use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceService implements ServiceServiceInterface
{
    public function getAll(): Collection
    {
        return Service::query()
            ->active()
            ->ordered()
            ->get();
    }

    public function getAllForAdmin(): Collection
    {
        return Service::query()
            ->orderBy('category')
            ->orderBy('sort_order')
            ->get();
    }

    public function getById(string $id): Service
    {
        return Service::findOrFail($id);
    }
}
