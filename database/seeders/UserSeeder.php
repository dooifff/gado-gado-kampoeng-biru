<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'email' => 'owner@example.test',
                'name' => 'Owner',
                'password' => 'owner12345',
                'role' => 'owner',
            ],
            [
                'email' => 'admin@example.test',
                'name' => 'Admin',
                'password' => 'admin12345',
                'role' => 'admin',
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                ],
            );
        }
    }
}