<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Usuarios normales
        $usuarios = [
            ['name' => 'Juan Pérez', 'email' => 'juan@test.com'],
            ['name' => 'María García', 'email' => 'maria@test.com'],
            ['name' => 'Carlos López', 'email' => 'carlos@test.com'],
            ['name' => 'Ana Martín', 'email' => 'ana@test.com'],
        ];

        foreach ($usuarios as $u) {
            User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }
    }
}
