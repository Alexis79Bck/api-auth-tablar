<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name'=> "SuperAdmin", 'guard_name' => 'web'],
            ['name'=> "Admin", 'guard_name' => 'web'],
            ['name'=> "User", 'guard_name' => 'web'],
        ];
        DB::table('roles')->insert($roles);
        
        $permissions = [ 
            ['name' => "list users", 'guard_name' => 'web'],
            ['name' => "create user", 'guard_name' => 'web'],
            ['name' => "show user profile", 'guard_name' => 'web'],
            ['name' => "edit user", 'guard_name' => 'web'],
            ['name' => "delete user", 'guard_name' => 'web'],
            ['name' => "list roles", 'guard_name' => 'web'],
            ['name' => "create role", 'guard_name' => 'web'],            
            ['name' => "edit role", 'guard_name' => 'web'],
            ['name' => "delete role", 'guard_name' => 'web'],
            ['name' => "assign role to user", 'guard_name' => 'web'],
            ['name' => "list permissions", 'guard_name' => 'web'],
            ['name' => "create permission", 'guard_name' => 'web'],            
            ['name' => "edit permission", 'guard_name' => 'web'],
            ['name' => "delete permission", 'guard_name' => 'web'],
            ['name' => "assign permission to role", 'guard_name' => 'web'],
        ];
        DB::table('permissions')->insert($permissions); 
    }
}
