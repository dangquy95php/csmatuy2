<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'username1',
            'username' => 'username1',
            'email' => 'username1@gmail.com',
            'status' => '1',
            'email_verified_at' => now(),
            'password' => 'username1',
        ]);

        $role = Role::create(['name' => 'staff']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $user1 = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'status' => '1',
            'email_verified_at' => now(),
            'password' => 'admin',
        ]);

        $role1 = Role::create(['name' => 'admin']);
     
        $permissions1 = Permission::pluck('id','id')->all();
   
        $role1->syncPermissions($permissions1);
        $user1->assignRole([$role1->id]);

        $user = User::create([
            'name' => 'phó phòng',
            'username' => 'phophong',
            'email' => 'phophong@gmail.com',
            'status' => '1',
            'email_verified_at' => now(),
            'password' => 'phophong',
        ]);

        $role = Role::create(['name' => 'deputy']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $user = User::create([
            'name' => 'trưởng phòng',
            'username' => 'truongphong',
            'email' => 'truongphong@gmail.com',
            'status' => '1',
            'email_verified_at' => now(),
            'password' => 'truongphong',
        ]);

        $role = Role::create(['name' => 'manager']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
