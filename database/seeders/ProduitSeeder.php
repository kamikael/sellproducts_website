<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('produits')->insert([
            [
                'nom' => 'Baguette Tradition',
                'description' => 'Pain croustillant et doré.',
                'prix' => 1.20,
                'image_url' => null,
                'stand_id' => 1, // Boulangerie du Coin
            ],
            [
                'nom' => 'Croissant au Beurre',
                'description' => 'Viennoiserie feuilletée.',
                'prix' => 1.50,
                'image_url' => null,
                'stand_id' => 1, // Boulangerie du Coin
            ],
            [
                'nom' => 'Pizza Margherita',
                'description' => 'Tomate, mozzarella, basilic.',
                'prix' => 8.50,
                'image_url' => null,
                'stand_id' => 2, // Pizza Bella
            ],
            [
                'nom' => 'Pizza Quatre Fromages',
                'description' => 'Mozzarella, gorgonzola, parmesan, chèvre.',
                'prix' => 10.00,
                'image_url' => null,
                'stand_id' => 2, // Pizza Bella
            ],
            [
                'nom' => 'Couscous Royal',
                'description' => 'Semoule, légumes, viandes.',
                'prix' => 12.00,
                'image_url' => null,
                'stand_id' => 3, // Le Traiteur
            ],
            [
                'nom' => 'Tajine de Poulet',
                'description' => 'Poulet aux olives et citrons confits.',
                'prix' => 11.50,
                'image_url' => null,
                'stand_id' => 3, // Le Traiteur
            ],
            [
                'nom' => 'Tablette Chocolat Noir',
                'description' => 'Chocolat pur cacao.',
                'prix' => 3.00,
                'image_url' => null,
                'stand_id' => 4, // Choco Délices
            ],
            [
                'nom' => 'Truffes au Chocolat',
                'description' => 'Truffes artisanales.',
                'prix' => 2.50,
                'image_url' => null,
                'stand_id' => 4, // Choco Délices
            ],
            [
                'nom' => 'Rôti de Bœuf',
                'description' => 'Viande de qualité supérieure.',
                'prix' => 15.00,
                'image_url' => null,
                'stand_id' => 5, // Boucherie Fine
            ],
            [
                'nom' => 'Saucisson Sec',
                'description' => 'Charcuterie artisanale.',
                'prix' => 3.80,
                'image_url' => null,
                'stand_id' => 5, // Boucherie Fine
            ],
            [
                'nom' => 'Éclair au Chocolat',
                'description' => 'Pâtisserie gourmande.',
                'prix' => 2.50,
                'image_url' => null,
                'stand_id' => 6, // Pâtisserie Sucrée
            ],
            [
                'nom' => 'Tarte aux Pommes',
                'description' => 'Tarte traditionnelle.',
                'prix' => 3.00,
                'image_url' => null,
                'stand_id' => 6, // Pâtisserie Sucrée
            ],
            [
                'nom' => 'Panier de Légumes',
                'description' => 'Assortiment de légumes frais.',
                'prix' => 7.00,
                'image_url' => null,
                'stand_id' => 7, // Le Marché Local
            ],
        ]);
    }
}
