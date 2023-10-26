<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'fullname' => 'John Doe',
            'birthday' => '1990-02-25',
            'country' => 'Venezuela',
            'city' => 'Ciudad Bolívar',
            'address' => null,
            'phone' => null,
            'email' => 'jdoe@example.com',
            'username' => 'jdoe43',
            'password' => Hash::make('testing123'),
        ]);
    }
}
