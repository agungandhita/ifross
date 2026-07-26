<?php

namespace App\Services\VideotronSpec;

use App\DTOs\VideotronSpec\SaveVideotronSpecDTO;
use App\Models\Service\VideotronSpec;

interface VideotronSpecServiceInterface
{
    /**
     * Get a paginated list of videotron specs.
     */
    public function getPaginated(string $search = '', int $perPage = 10);

    /**
     * Get a videotron spec by ID.
     */
    public function getById(string $id): VideotronSpec;

    /**
     * Save a videotron spec (create or update).
     */
    public function save(SaveVideotronSpecDTO $dto): VideotronSpec;

    /**
     * Delete a videotron spec by ID.
     */
    public function delete(string $id): bool;
}
