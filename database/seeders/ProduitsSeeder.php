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
                'emoji' => '🔷',
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
            [
                'nom' => 'BNB',
                'prix' => 6000,
                'duree' => 20,
                'revenu' => 9000,
                'emoji' => '🟡',
            ],
            [
                'nom' => 'XRP',
                'prix' => 3000,
                'duree' => 15,
                'revenu' => 4500,
                'emoji' => '✕',
            ],
            [
                'nom' => 'Cardano',
                'prix' => 2500,
                'duree' => 12,
                'revenu' => 3800,
                'emoji' => '₳',
            ],
            [
                'nom' => 'Solana',
                'prix' => 4000,
                'duree' => 18,
                'revenu' => 6200,
                'emoji' => '◎',
            ],
            [
                'nom' => 'Polkadot',
                'prix' => 3500,
                'duree' => 14,
                'revenu' => 5000,
                'emoji' => '◉',
            ],
            [
                'nom' => 'Dogecoin',
                'prix' => 1500,
                'duree' => 8,
                'revenu' => 2000,
                'emoji' => '🐕',
            ],
            [
                'nom' => 'Shiba Inu',
                'prix' => 1000,
                'duree' => 7,
                'revenu' => 1500,
                'emoji' => '🐕',
            ],
            [
                'nom' => 'Tron',
                'prix' => 1800,
                'duree' => 9,
                'revenu' => 2600,
                'emoji' => 'TRX',
            ],
        ];

        foreach ($produits as $produit) {
            Produit::create($produit);
        }
    }
}
