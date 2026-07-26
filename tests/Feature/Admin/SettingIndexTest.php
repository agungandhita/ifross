<?php

use App\Models\Site\SiteSetting;
use App\Models\User;
use App\Livewire\Admin\SettingIndex;
use Livewire\Livewire;

test('admin can open edit modal and save setting without type error', function () {
    $user = User::factory()->create();

    $setting = SiteSetting::create([
        'key' => 'test_setting_key',
        'value' => 'old_value',
        'type' => 'text',
        'label' => 'Test Setting Label',
        'group' => 'general',
        'description' => 'Test description',
    ]);

    Livewire::actingAs($user)
        ->test(SettingIndex::class)
        ->call('edit', 'test_setting_key')
        ->assertSet('showModal', true)
        ->assertSet('isEdit', true)
        ->assertSet('form.key', 'test_setting_key')
        ->assertSet('form.type', 'text')
        ->set('form.value', 'new_value')
        ->call('save')
        ->assertSet('showModal', false);

    expect(SiteSetting::find('test_setting_key')->value)->toBe('new_value');
});

test('admin can delete setting', function () {
    $user = User::factory()->create();

    SiteSetting::create([
        'key' => 'to_delete_key',
        'value' => 'some_val',
        'type' => 'text',
        'label' => 'Delete Test',
        'group' => 'general',
    ]);

    Livewire::actingAs($user)
        ->test(SettingIndex::class)
        ->call('delete', 'to_delete_key');

    expect(SiteSetting::find('to_delete_key'))->toBeNull();
});
