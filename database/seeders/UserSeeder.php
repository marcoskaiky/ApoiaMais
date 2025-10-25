<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar um usuário admin de teste
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@apoiamais.com',
            'password' => Hash::make('admin123'), // Altere para uma senha segura em produção
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Criar um usuário comum de teste
        User::create([
            'name' => 'Usuário Comum',
            'email' => 'user@apoiamais.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}
