<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrateur Eat&Drink',
            'email' => 'admin@eatdrink.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        $this->command->info('Administrateur créé avec succès !');
        $this->command->info('Email: admin@eatdrink.com');
        $this->command->info('Mot de passe: admin123');
    }
} 