<?php

namespace App\Services\Setting;

use App\DTOs\Setting\SaveSettingDTO;
use App\Models\Site\SiteSetting;

class SettingService implements SettingServiceInterface
{
    public function getPaginated(string $search = '', int $perPage = 10)
    {
        return SiteSetting::query()
            ->when($search, function ($q) use ($search) {
                $q->whereLike('key', $search)
                  ->orWhereLike('label', $search);
            })
            ->orderBy('key')
            ->paginate($perPage);
    }

    public function getByKey(string $key): SiteSetting
    {
        return SiteSetting::findOrFail($key);
    }

    public function save(SaveSettingDTO $dto): SiteSetting
    {
        return SiteSetting::updateOrCreate(
            ['key' => $dto->originalKey ?: $dto->key],
            [
                'key'         => $dto->key,
                'value'       => $dto->value,
                'type'        => $dto->type,
                'label'       => $dto->label,
                'group'       => $dto->group,
                'description' => $dto->description,
            ]
        );
    }

    public function delete(string $key): bool
    {
        $setting = SiteSetting::findOrFail($key);
        return $setting->delete();
    }
}
