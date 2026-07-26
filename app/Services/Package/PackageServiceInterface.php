<?php

namespace App\Services\Package;

use App\DTOs\Package\SavePackageDTO;
use App\Models\Service\Package;

interface PackageServiceInterface
{
    /**
     * Get a paginated list of packages.
     */
    public function getPaginated(string $search = '', string $serviceFilter = '', int $perPage = 10);

    /**
     * Get a package by ID.
     */
    public function getById(string $id): Package;

    /**
     * Save a package (create or update).
     */
    public function save(SavePackageDTO $dto): Package;

    /**
     * Delete a package by ID.
     */
    public function delete(string $id): bool;
}
