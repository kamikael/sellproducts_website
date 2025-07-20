<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Stand;
use App\Models\Produit;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Créer un entrepreneur approuvé
        $entrepreneur = User::create([
            'name' => 'Jean Dupont',
            'email' => 'jean@example.com',
            'password' => bcrypt('password'),
            'role' => 'entrepreneur_approuve',
        ]);

        // Créer un stand pour l'entrepreneur
        $stand = Stand::create([
            'nom_stand' => 'Stand Gourmet',
            'description' => 'Spécialisé dans les produits gastronomiques locaux',
            'user_id' => $entrepreneur->id,
        ]);

        // Créer quelques produits
        Produit::create([
            'nom' => 'Confiture de fraises',
            'description' => 'Confiture artisanale de fraises du jardin',
            'prix' => 5.50,
            'image_url' => 'https://via.placeholder.com/300x200?text=Confiture',
            'stand_id' => $stand->id,
        ]);

        Produit::create([
            'nom' => 'Pain au levain',
            'description' => 'Pain traditionnel au levain naturel',
            'prix' => 3.20,
            'image_url' => 'https://via.placeholder.com/300x200?text=Pain',
            'stand_id' => $stand->id,
        ]);

        Produit::create([
            'nom' => 'Miel de lavande',
            'description' => 'Miel pur de lavande de Provence',
            'prix' => 8.90,
            'image_url' => 'https://via.placeholder.com/300x200?text=Miel',
            'stand_id' => $stand->id,
        ]);

        // Créer un deuxième entrepreneur
        $entrepreneur2 = User::create([
            'name' => 'Marie Martin',
            'email' => 'marie@example.com',
            'password' => bcrypt('password'),
            'role' => 'entrepreneur_approuve',
        ]);

        $stand2 = Stand::create([
            'nom_stand' => 'Stand Artisanat',
            'description' => 'Objets artisanaux et créations uniques',
            'user_id' => $entrepreneur2->id,
        ]);

        Produit::create([
            'nom' => 'Bracelet en cuir',
            'description' => 'Bracelet artisanal en cuir véritable',
            'prix' => 15.00,
            'image_url' => 'https://via.placeholder.com/300x200?text=Bracelet',
            'stand_id' => $stand2->id,
        ]);

        Produit::create([
            'nom' => 'Pot en céramique',
            'description' => 'Pot décoratif en céramique peinte à la main',
            'prix' => 25.00,
            'image_url' => 'https://via.placeholder.com/300x200?text=Pot',
            'stand_id' => $stand2->id,
        ]);
    }
}
