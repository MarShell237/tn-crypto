<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produit;

class ProduitsSeeder extends Seeder
{
    public function run(): void
    {
        $produits = [
            [
                'nom' => 'Bitcoin',
                'prix' => 10000,
                'duree' => 30,
                'revenu' => 15000,
                'emoji' => '₿',
            ],
            [
                'nom' => 'Ethereum',
                'prix' => 7000,
                'duree' => 25,
                'revenu' => 11000,
                'emoji' => 'Ξ',
            ],
            [
                'nom' => 'Litecoin',
                'prix' => 5000,
                'duree' => 20,
                'revenu' => 8000,
                'emoji' => 'Ł',
            ],
            [
                'nom' => 'USDT',
                'prix' => 2000,
                'duree' => 10,
                'revenu' => 2500,
                'emoji' => '₮',
            ],
        ];

        foreach ($produits as $produit) {
            Produit::create($produit);
        }
    }
}

