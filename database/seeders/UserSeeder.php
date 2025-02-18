<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin
        User::create([
            'name' => 'admin user',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456789'),
            'role' => 'admin',
        ]);

        //Agent
        User::create([
            'name' => 'agent user',
            'email' => 'agent@agent.com',
            'password' => Hash::make('123456789'),
            'role' => 'agent',
        ]);

        //User
        User::create([
            'name' => 'user user',
            'email' => 'user@user.com',
            'password' => Hash::make('123456789'),
            'role' => 'user',
        ]);
    }
}
