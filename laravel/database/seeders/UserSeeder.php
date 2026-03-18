<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'password123',
            'role' => 'Admin',
        ]);

        User::Create([
            'name' => 'achraf',
            'email' => 'achraf@gmail.com',
            'password' => 'password123',
            'role' => 'Employee',
        ]);

        User::Create([
            'name' => 'rayan',
            'email' => 'rayan@gmail.com',
            'password' => 'password123',
            'role' => 'Client',
        ]);
    }
}
