<?php

namespace App\Services\Addon;

use App\DTOs\Addon\SaveAddonDTO;
use App\Models\Service\AddonItem;

interface AddonServiceInterface
{
    /**
     * Get a paginated list of addons.
     */
    public function getPaginated(string $search = '', string $serviceFilter = '', int $perPage = 10);

    /**
     * Get an addon by ID.
     */
    public function getById(string $id): AddonItem;

    /**
     * Save an addon (create or update).
     */
    public function save(SaveAddonDTO $dto): AddonItem;

    /**
     * Delete an addon by ID.
     */
    public function delete(string $id): bool;
}
