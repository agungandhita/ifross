<?php

namespace App\Services\Banner;

use App\DTOs\Banner\SaveBannerDTO;
use App\Models\Site\Banner;

interface BannerServiceInterface
{
    /**
     * Get a paginated list of banners.
     */
    public function getPaginated(string $search = '', int $perPage = 10);

    /**
     * Get a banner by ID.
     */
    public function getById(string $id): Banner;

    /**
     * Save a banner (create or update).
     */
    public function save(SaveBannerDTO $dto): Banner;

    /**
     * Delete a banner by ID.
     */
    public function delete(string $id): bool;
}
