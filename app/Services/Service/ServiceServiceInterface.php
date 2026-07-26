<?php

namespace App\Services\Service;

use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Collection;

interface ServiceServiceInterface
{
    /**
     * Get all active services ordered by sort_order.
     *
     * @return Collection<int, Service>
     */
    public function getAll(): Collection;

    /**
     * Get all services (including inactive) ordered by category then sort_order.
     *
     * @return Collection<int, Service>
     */
    public function getAllForAdmin(): Collection;

    /**
     * Get service by ID.
     */
    public function getById(string $id): Service;
}
