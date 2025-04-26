<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario tipo Agente
        User::create([
            'name' => 'Agent Demo',
            'email' => 'agent@example.com',
            'password' => Hash::make('password'),
            'role' => 'agent',
        ]);

        // Usuario tipo Usuario
        User::create([
            'name' => 'User Demo',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}