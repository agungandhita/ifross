<?php

namespace App\Services\Portfolio;

use App\DTOs\Portfolio\SavePortfolioDTO;
use App\Models\Portfolio\Portfolio;

interface PortfolioServiceInterface
{
    /**
     * Get a paginated list of portfolios.
     */
    public function getPaginated(string $search = '', string $categoryFilter = '', int $perPage = 10);

    /**
     * Get a portfolio by ID.
     */
    public function getById(string $id): Portfolio;

    /**
     * Save a portfolio (create or update).
     */
    public function save(SavePortfolioDTO $dto): Portfolio;

    /**
     * Get all portfolios (minimal fields) for dropdown/select input.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, Portfolio>
     */
    public function getAllForDropdown(): \Illuminate\Database\Eloquent\Collection;

    /**
     * Delete a portfolio by ID.
     */
    public function delete(string $id): bool;
}
