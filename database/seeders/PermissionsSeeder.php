<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        Permission::create(['name' => 'CRUD Items']);
        Permission::create(['name' => 'CRUD Rooms']);
        Permission::create(['name' => 'Create Loans']);
        Permission::create(['name' => 'Edit Loans']);
        Permission::create(['name' => 'Delete Loans']);
        Permission::create(['name' => 'Return Items']);
    }
}
