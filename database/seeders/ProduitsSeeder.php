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
                'prix' => 1000000,
                'duree' => 40,
                'revenu' => 150000,
                'emoji' => '₿',
            ],
            [
                'nom' => 'Ethereum',
                'prix' => 900000,
                'duree' => 40,
                'revenu' => 135000,
                'emoji' => '🔷',
            ],
            [
                'nom' => 'Litecoin',
                'prix' => 700000,
                'duree' => 40,
                'revenu' => 105000,
                'emoji' => 'Ł',
            ],
            [
                'nom' => 'USDT',
                'prix' => 450000,
                'duree' => 40,
                'revenu' => 67500,
                'emoji' => '₮',
            ],
            [
                'nom' => 'BNB',
                'prix' => 220000,
                'duree' => 40,
                'revenu' => 33000,
                'emoji' => '🟡',
            ],
            [
                'nom' => 'XRP',
                'prix' => 150000,
                'duree' => 40,
                'revenu' => 25500,
                'emoji' => '✕',
            ],
            [
                'nom' => 'Cardano',
                'prix' => 75000,
                'duree' => 40,
                'revenu' => 11250,
                'emoji' => '₳',
            ],
            [
                'nom' => 'Solana',
                'prix' => 50000,
                'duree' => 40,
                'revenu' => 7500,
                'emoji' => '◎',
            ],
            [
                'nom' => 'Polkadot',
                'prix' => 30000,
                'duree' => 40,
                'revenu' => 4500,
                'emoji' => '◉',
            ],
            [
                'nom' => 'Dogecoin',
                'prix' => 10000,
                'duree' => 40,
                'revenu' => 1500,
                'emoji' => '🐕',
            ],
            [
                'nom' => 'Shiba Inu',
                'prix' => 5000,
                'duree' => 40,
                'revenu' => 750,
                'emoji' => '🐕',
            ],
            [
                'nom' => 'Tron',
                'prix' => 7000,
                'duree' => 40,
                'revenu' => 1050,
                'emoji' => 'TRX',
            ],
        ];

        foreach ($produits as $produit) {
            Produit::create($produit);
        }
    }
}
