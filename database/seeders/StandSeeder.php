<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stands')->insert([
            // Stands pour les entrepreneurs approuvés
            [
                'nom_stand' => 'Boulangerie du Coin',
                'description' => 'Pains et viennoiseries artisanales, fraîchement préparés chaque jour.',
                'user_id' => 2, // Jean Dupont - entrepreneur_approuve
            ],
            [
                'nom_stand' => 'Pizza Bella',
                'description' => 'Pizzas italiennes authentiques cuites au feu de bois, avec des ingrédients frais.',
                'user_id' => 3, // Maria Rossi - entrepreneur_approuve
            ],
            [
                'nom_stand' => 'Le Traiteur Saveurs',
                'description' => 'Plats cuisinés traditionnels et exotiques pour toutes vos occasions.',
                'user_id' => 4, // Karim Ben - entrepreneur_approuve
            ],
            [
                'nom_stand' => 'Choco Délices',
                'description' => 'Chocolats artisanaux et confiseries faites maison pour les gourmands.',
                'user_id' => 5, // Sophie Martin - entrepreneur_approuve
            ],
            [
                'nom_stand' => 'Boucherie Fine Luc',
                'description' => 'Viandes de qualité supérieure et charcuteries artisanales, sélectionnées avec soin.',
                'user_id' => 9, // Luc Boucher - entrepreneur_approuve
            ],
            [
                'nom_stand' => 'Pâtisserie Sucrée Julie',
                'description' => 'Gâteaux, tartes et pâtisseries fines pour égayer vos desserts.',
                'user_id' => 10, // Julie Sucre - entrepreneur_approuve
            ],

            // Stands pour les entrepreneurs en attente (ils ont aussi un stand, mais leur statut est en attente)
            [
                'nom_stand' => 'Saveurs d\'Asie',
                'description' => 'Spécialités asiatiques authentiques, des sushis aux plats sautés.',
                'user_id' => 6, // Li Wang - entrepreneur_en_attente
            ],
            [
                'nom_stand' => 'Vegan Fresh',
                'description' => 'Options saines et délicieuses 100% végétaliennes, pour un mode de vie équilibré.',
                'user_id' => 7, // Emma Green - entrepreneur_en_attente
            ],
            [
                'nom_stand' => 'La Fromagerie du Coin',
                'description' => 'Large sélection de fromages locaux et importés, affinés avec passion.',
                'user_id' => 8, // Paul Fromage - entrepreneur_en_attente
            ],
        ]);
    }
}
