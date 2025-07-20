<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommandeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('commandes')->insert([
            [
                'stand_id' => 1, // Boulangerie du Coin
                'details_commande' => json_encode(['produits' => [['nom' => 'Baguette Tradition', 'quantite' => 2]]]),
                'date_commande' => now(),
            ],
            [
                'stand_id' => 2, // Pizza Bella
                'details_commande' => json_encode(['produits' => [['nom' => 'Pizza Margherita', 'quantite' => 1]]]),
                'date_commande' => now(),
            ],
            [
                'stand_id' => 3, // Le Traiteur
                'details_commande' => json_encode(['produits' => [['nom' => 'Couscous Royal', 'quantite' => 3]]]),
                'date_commande' => now(),
            ],
            [
                'stand_id' => 4, // Choco Délices
                'details_commande' => json_encode(['produits' => [['nom' => 'Tablette Chocolat Noir', 'quantite' => 5]]]),
                'date_commande' => now(),
            ],
            [
                'stand_id' => 5, // Boucherie Fine
                'details_commande' => json_encode(['produits' => [['nom' => 'Rôti de Bœuf', 'quantite' => 1]]]),
                'date_commande' => now(),
            ],
            [
                'stand_id' => 6, // Pâtisserie Sucrée
                'details_commande' => json_encode(['produits' => [['nom' => 'Éclair au Chocolat', 'quantite' => 6]]]),
                'date_commande' => now(),
            ],
            [
                'stand_id' => 7, // Le Marché Local
                'details_commande' => json_encode(['produits' => [['nom' => 'Panier de Légumes', 'quantite' => 1]]]),
                'date_commande' => now(),
            ],
        ]);
    }
}
