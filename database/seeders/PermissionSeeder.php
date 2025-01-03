<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'user-list']);
        Permission::create(['name' => 'user-create']);
        Permission::create(['name' => 'user-edit']);
        Permission::create(['name' => 'user-delete']);

        Permission::create(['name' => 'role-list']);
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-edit']);
        Permission::create(['name' => 'role-delete']);

        Permission::create(['name' => 'permission-list']);
        Permission::create(['name' => 'permission-create']);
        Permission::create(['name' => 'permission-edit']);
        Permission::create(['name' => 'permission-delete']);

        Permission::create(['name' => 'gate-create']);
        Permission::create(['name' => 'gate-list']);
        Permission::create(['name' => 'gate-edit']);
        Permission::create(['name' => 'gate-delete']);
        Permission::create(['name' => 'gate-input']);

        Permission::create(['name' => 'team-index']);
        Permission::create(['name' => 'team-create']);
        Permission::create(['name' => 'team-edit']);
        Permission::create(['name' => 'team-delete']);

        Permission::create(['name' => 'excel-import']);
        Permission::create(['name' => 'log-list']);
        Permission::create(['name' => 'permit-list']);


        Permission::create(['name' => 'law-index']);
        Permission::create(['name' => 'law-create']);
        Permission::create(['name' => 'law-edit']);
        Permission::create(['name' => 'law-delete']);

        Permission::create(['name' => 'contest-index']);
        Permission::create(['name' => 'contest-create']);
        Permission::create(['name' => 'contest-edit']);
        Permission::create(['name' => 'contest-delete']);
    }
}
