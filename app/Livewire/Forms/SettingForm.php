<?php

namespace App\Livewire\Forms;

use App\Enums\SettingType;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SettingForm extends Form
{
    public string $originalKey = '';

    public string $key = '';

    public ?string $value = null;

    #[Validate('required|string|max:255')]
    public string $label = '';

    public string $type = 'text';

    #[Validate('required|string|max:255')]
    public string $group = 'general';

    #[Validate('nullable|string')]
    public ?string $description = null;

    protected function rules(): array
    {
        $allowedTypes = array_column(SettingType::cases(), 'value');

        return [
            'key' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9_]+$/',
                Rule::unique('site_settings', 'key')->ignore($this->originalKey, 'key'),
            ],
            'value' => 'nullable|string',
            'type'  => ['required', Rule::in($allowedTypes)],
        ];
    }

    public function setSetting($setting)
    {
        $this->originalKey = $setting->key;
        $this->key         = $setting->key;
        $this->value       = $setting->value;
        $this->label       = $setting->label;
        $this->type        = $setting->type instanceof SettingType ? $setting->type->value : (string) $setting->type;
        $this->group       = $setting->group;
        $this->description = $setting->description;
    }

    public function clear()
    {
        $this->reset(['originalKey', 'key', 'value', 'label', 'type', 'group', 'description']);
        $this->type = 'text';
        $this->group = 'general';
        $this->resetValidation();
    }
}
