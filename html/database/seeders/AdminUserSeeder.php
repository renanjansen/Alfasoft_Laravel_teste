<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Verificar se o usuário já existe
        if (!User::where('email', 'admin@alfasoft.pt')->exists()) {
            User::create([
                'name' => 'Administrador',
                'email' => 'admin@alfasoft.pt',
                'password' => Hash::make('password123'),
            ]);
            $this->command->info('✅ Usuário admin criado com sucesso!');
        } else {
            $this->command->info('⚠️ Usuário admin já existe.');
        }
    }
}
