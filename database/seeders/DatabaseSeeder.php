<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Admin User ──────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'admin@ifrossmultimedia.com'],
            [
                'name'     => 'Admin IFROSS',
                'email'    => 'admin@ifrossmultimedia.com',
                'password' => Hash::make('ifross2024!'),
            ]
        );

        // ─── Seeders ─────────────────────────────────────────────────
        $this->call([
            SiteSettingSeeder::class,
            ServiceSeeder::class,
            PortfolioSeeder::class,
        ]);
    }
}
