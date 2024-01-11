<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * List of permissions to add.
     */
    private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'item-list',
        'item-create',
        'item-edit',
        'item-delete',
        'user-list',
        'user-create',
        'user-edit',
        'user-delete',
        'request-list',
        'request-create',
        'request-edit',
        'request-delete'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $donorRole = Role::firstOrCreate(['name' => 'donor']);
        $doneeRole = Role::firstOrCreate(['name' => 'donee']);

        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole->syncPermissions($this->permissions);

        $donorRole->syncPermissions([
            'item-list',
            'item-create',
            'item-edit',
            'item-delete',
            'request-list',
            'request-create',
            'request-edit',
            'request-delete'
        ]);

        $doneeRole->syncPermissions([
            'item-list',
            'request-list',
            'request-create',
        ]);
    }
}
