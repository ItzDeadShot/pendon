<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();
        $this->truncate('users');

        // Create test user and assign it as donor
        \App\Models\User::factory(1)->state([
            'name' => 'Donor User',
            'email' => 'donor@email.com',
        ])->create()->each(function ($user) {
            $user->assignRole('donor');
        });

        // Create test user and assign it as donee
        \App\Models\User::factory(1)->state([
            'name' => 'Donee User',
            'email' => 'donee@email.com',
        ])->create()->each(function ($user) {
            $user->assignRole('donee');
        });

        // Create and assign three donor users
        \App\Models\User::factory(3)->create()->each(function ($user) {
            $user->assignRole('donor');
        });

        // Create and assign three donee users
        \App\Models\User::factory(3)->create()->each(function ($user) {
            $user->assignRole('donee');
        });
        $this->enableForeignKeys();
    }
}
