<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'product-list',
           'product-create',
           'product-edit',  
           'product-delete',
           'task-create',
           'task-list',
           'task-edit',
           'task-delete',
           'task-assign',
           'project-create',
           'project-edit',
           'project-list',
           'project-delete',
           'user-create',
           'user-list',
           'user-edit',
           'user-delete',
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
