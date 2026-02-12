<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder{
    public function run(): void
    {
        Role::create(['name' => 'chercheur', 'guard_name' => 'web']);
        Role::create(['name' => 'recruteur', 'guard_name' => 'web']);

        $this->command->info('Roles created successfully!');
    }
}