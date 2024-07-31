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
        $role = Role::create(['name' => 'user']);
        $user = User::create([
            'name' => 'username1',
            'username' => 'username1',
            'email' => 'username1@gmail.com',
            'status' => '1',
            'email_verified_at' => now(),
            'password' => 'username1',
            'team_id' => null,
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
            'team_id' => null
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
            'team_id' => null
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
            'team_id' =>  null
        ]);

        $role = Role::create(['name' => 'manager']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        // --------------------------------------
    //     $user2 = User::create([
    //         'name' => 'Nguyễn Ngọc Tuân',
    //         'username' => 'nguyenngoctuan',
    //         'email' => 'nguyenngoctuan@gmail.com',
    //         'status' => '1',
    //         'email_verified_at' => now(),
    //         'password' => 'nguyenngoctuan',
    //         'team_id' => 11,
    //     ]);

    //     $role2 = Role::where('name', 'deputy')->first();
        
    //     $permissions2 = Permission::pluck('id','id')->all();
    
    //     $role2->syncPermissions($permissions2);
    //     $user2->assignRole([$role2->id]);

    //     $user3 = User::create([
    //         'name' => 'Võ Văn Lợi',
    //         'username' => 'vovanloi',
    //         'email' => 'vovanloi@gmail.com',
    //         'status' => '1',
    //         'email_verified_at' => now(),
    //         'password' => 'vovanloi',
    //         'team_id' => 11,
    //     ]);

    //     $role3 = Role::where('name', 'deputy')->first();

    //     $permissions3 = Permission::pluck('id','id')->all();
    
    //     $role3->syncPermissions($permissions3);
    //     $user3->assignRole([$role3->id]);

        
    //     $user4 = User::create([
    //         'name' => 'Phạm Viết Sơn',
    //         'username' => 'phamvietson',
    //         'email' => 'phamvietson@gmail.com',
    //         'status' => '1',
    //         'email_verified_at' => now(),
    //         'password' => 'phamvietson',
    //         'team_id' => 1,
    //     ]);

    //     $role4 = Role::where('name', 'deputy')->first();
        
    //     $permissions4 = Permission::pluck('id','id')->all();
    
    //     $role4->syncPermissions($permissions4);
    //     $user4->assignRole([$role4->id]);

    //     $user4 = User::create([
    //         'name' => 'Lê Đình Đức',
    //         'username' => 'ledinhduc',
    //         'email' => 'ledinhduc@gmail.com',
    //         'status' => '1',
    //         'email_verified_at' => now(),
    //         'password' => 'ledinhduc',
    //         'team_id' => 1,
    //     ]);

    //     $role4 = Role::where('name', 'deputy')->first();
        
    //     $permissions4 = Permission::pluck('id','id')->all();
    
    //     $role4->syncPermissions($permissions4);
    //     $user4->assignRole([$role4->id]);

        
    //     $user5 = User::create([
    //         'name' => 'Đặng Văn Tuấn',
    //         'username' => 'dangvantuan',
    //         'email' => 'dangvantuan@gmail.com',
    //         'status' => '1',
    //         'email_verified_at' => now(),
    //         'password' => 'dangvantuan',
    //         'team_id' => 10,
    //     ]);

    //     $role5 = Role::where('name', 'manager')->first();
        
    //     $permissions5 = Permission::pluck('id','id')->all();
    
    //     $role5->syncPermissions($permissions5);
    //     $user5->assignRole([$role5->id]);
    }
}
