<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StandSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stands')->insert([
            [
                'nom_stand' => 'Boulangerie du Coin',
                'description' => 'Pains et viennoiseries artisanales.',
                'user_id' => 2, // Jean Dupont - approuvé
            ],
            [
                'nom_stand' => 'Pizza Bella',
                'description' => 'Pizzas italiennes au feu de bois.',
                'user_id' => 3, // Maria Rossi - approuvé
            ],
            [
                'nom_stand' => 'Le Traiteur',
                'description' => 'Plats cuisinés traditionnels.',
                'user_id' => 4, // Karim Ben - approuvé
            ],
            [
                'nom_stand' => 'Choco Délices',
                'description' => 'Chocolats et confiseries maison.',
                'user_id' => 5, // Sophie Martin - approuvé
            ],
            [
                'nom_stand' => 'Boucherie Fine',
                'description' => 'Viandes et charcuteries de qualité.',
                'user_id' => 9, // Luc Boucher - approuvé
            ],
            [
                'nom_stand' => 'Pâtisserie Sucrée',
                'description' => 'Gâteaux et pâtisseries fines.',
                'user_id' => 10, // Julie Sucre - approuvé
            ],
            [
                'nom_stand' => 'Le Marché Local',
                'description' => 'Produits frais et locaux.',
                'user_id' => 2, // Jean Dupont - approuvé (2ème stand)
            ],
        ]);
    }
}
