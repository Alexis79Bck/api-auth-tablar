<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creando el usuario prueba John Doe
        $user = new User;
        $user->fullname = 'John Doe';
        $user->birthday = '1990-02-25';
        $user->country = 'Venezuela';
        $user->city = 'Ciudad Bolívar';
        $user->address = null;
        $user->phone = null;
        $user->email = 'jdoe@example.com';
        $user->username = 'jdoe43';
        $user->password = Hash::make('testing123');
        $user->save();
        $user->assignRole('SuperAdmin'); 
    }
}
