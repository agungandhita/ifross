<?php

namespace App\Services\Setting;

use App\DTOs\Setting\SaveSettingDTO;
use App\Models\Site\SiteSetting;

interface SettingServiceInterface
{
    /**
     * Get a paginated list of settings.
     */
    public function getPaginated(string $search = '', int $perPage = 10);

    /**
     * Get a setting by Key.
     */
    public function getByKey(string $key): SiteSetting;

    /**
     * Save a setting (create or update).
     */
    public function save(SaveSettingDTO $dto): SiteSetting;

    /**
     * Delete a setting by Key.
     */
    public function delete(string $key): bool;
}
