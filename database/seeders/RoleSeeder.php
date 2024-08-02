<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $pengelolaRole = Role::create(['name' => 'Pengelola']);
        $peminjamRole = Role::create(['name' => 'Peminjam']);

        // Sinkronisasi User & Role
        $user1 = User::find(1);
        $user2 = User::find(2);
        $user3 = User::find(3);
        $user4 = User::find(4);

        $user1->assignRole('Admin');
        $user2->assignRole('Pengelola');
        $user3->assignRole('Peminjam');
        $user4->assignRole('Peminjam');

        // Assign permissions to roles
        $crudItemsPermission = Permission::where('name', 'CRUD Items')->first();
        $crudRoomsPermission = Permission::where('name', 'CRUD Rooms')->first();
        $createLoansPermission = Permission::where('name', 'Create Loans')->first();
        $editLoansPermission = Permission::where('name', 'Edit Loans')->first();
        $deleteLoansPermission = Permission::where('name', 'Delete Loans')->first();
        $returnItemsPermission = Permission::where('name', 'Return Items')->first();

        if ($crudItemsPermission) {
            $adminRole->givePermissionTo($crudItemsPermission);
        }

        if ($crudRoomsPermission) {
            $pengelolaRole->givePermissionTo($crudRoomsPermission);
        }

        if ($createLoansPermission) {
            $peminjamRole->givePermissionTo($createLoansPermission);
        }

        if ($editLoansPermission) {
            $adminRole->givePermissionTo($editLoansPermission);
            $pengelolaRole->givePermissionTo($editLoansPermission);
        }

        if ($deleteLoansPermission) {
            $adminRole->givePermissionTo($deleteLoansPermission);
            $pengelolaRole->givePermissionTo($deleteLoansPermission);
        }

        if ($returnItemsPermission) {
            $adminRole->givePermissionTo($returnItemsPermission);
        }
    }
}
