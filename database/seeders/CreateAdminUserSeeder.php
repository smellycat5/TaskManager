<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dd($role);
        $user = User::create([
            'name' => 'SuperAdmin', 
            'email' => 'test@test.com',
            'password' => bcrypt('test1234')
        ]);
        
        $role = Role::find(1);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
        // dd($user);
    }
}
