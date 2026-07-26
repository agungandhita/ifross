<?php

namespace App\Services\Promo;

use App\DTOs\Promo\SavePromoDTO;
use App\Models\Service\Promo;

interface PromoServiceInterface
{
    /**
     * Get paginated list of promos with optional search & package filter.
     */
    public function getPaginated(string $search = '', string $packageFilter = '', int $perPage = 10);

    /**
     * Get a single promo by ID.
     */
    public function getById(string $id): Promo;

    /**
     * Create or update a promo.
     */
    public function save(SavePromoDTO $dto): Promo;

    /**
     * Delete a promo by ID.
     */
    public function delete(string $id): bool;

    /**
     * Get the currently active promo for a given package (if any).
     */
    public function getActivePromoForPackage(string $packageId): ?Promo;
}
