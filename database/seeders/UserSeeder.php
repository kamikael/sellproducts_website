<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Principal',
                'email' => 'admin@eatdrink.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Jean Dupont',
                'email' => 'jean@boulangerie.com',
                'password' => Hash::make('password'),
                'role' => 'entrepreneur_approuve',
            ],
            [
                'name' => 'Maria Rossi',
                'email' => 'maria@pizzabella.com',
                'password' => Hash::make('password'),
                'role' => 'entrepreneur_approuve',
            ],
            [
                'name' => 'Karim Ben',
                'email' => 'karim@traiteur.com',
                'password' => Hash::make('password'),
                'role' => 'entrepreneur_approuve',
            ],
            [
                'name' => 'Sophie Martin',
                'email' => 'sophie@choco.com',
                'password' => Hash::make('password'),
                'role' => 'entrepreneur_approuve',
            ],
            [
                'name' => 'Li Wang',
                'email' => 'li@saveursasie.com',
                'password' => Hash::make('password'),
                'role' => 'entrepreneur_en_attente',
            ],
            [
                'name' => 'Emma Green',
                'email' => 'emma@veganfresh.com',
                'password' => Hash::make('password'),
                'role' => 'entrepreneur_en_attente',
            ],
            [
                'name' => 'Paul Fromage',
                'email' => 'paul@fromager.com',
                'password' => Hash::make('password'),
                'role' => 'entrepreneur_en_attente',
            ],
            [
                'name' => 'Luc Boucher',
                'email' => 'luc@boucherie.com',
                'password' => Hash::make('password'),
                'role' => 'entrepreneur_approuve',
            ],
            [
                'name' => 'Julie Sucre',
                'email' => 'julie@patisserie.com',
                'password' => Hash::make('password'),
                'role' => 'entrepreneur_approuve',
            ],
        ]);
    }
}
