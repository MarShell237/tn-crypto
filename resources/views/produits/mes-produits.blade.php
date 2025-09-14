@extends('layouts.app')

@section('title', 'Mes Produits Crypto')

@section('content')
<div class="produit-container">
    <h2 class="produit-title"><i class="fas fa-wallet"></i> Mes Produits Achetés</h2>

    @if($produits->isEmpty())
        <p style="font-size:1.2rem; color:#555;">Vous n’avez encore acheté aucun produit.</p>
    @else
        <div class="crypto-grid">
            @foreach($produits as $produit)
                @php
                    // Définir dynamiquement le gradient et la couleur du bouton selon la crypto
                    $colors = [
                        'Bitcoin' => ['#fff7e6', '#ffe082', '#f7931a'],
                        'Ethereum' => ['#eef2ff', '#c7d2fe', '#3c3cce'],
                        'Litecoin' => ['#f8f9fa', '#e9ecef', '#6c757d'],
                        'Ripple' => ['#e0f7fa', '#81d4fa', '#0288d1'],
                        'BNB' => ['#fffde7', '#ffeb3b', '#f3ba2f'],
                        'Cardano' => ['#e8f5e9', '#a5d6a7', '#0066ff'],
                        'Solana' => ['#e0f7fa', '#80deea', '#00c4b3'],
                        'Polkadot' => ['#fce4ec', '#f8bbd0', '#e6007a'],
                        'Dogecoin' => ['#fffde7', '#fff59d', '#c2a633'],
                        'Avalanche' => ['#ffebee', '#ffcdd2', '#e84142'],
                        'Shiba Inu' => ['#fff3e0', '#ffe0b2', '#ff4500'],
                        'Tron' => ['#f3e5f5', '#ce93d8', '#d9021b'],
                    ];

                    $gradient = $colors[$produit->nom][0] ?? '#ffffff';
                    $gradient2 = $colors[$produit->nom][1] ?? '#f0f0f0';
                @endphp

                <div class="crypto-card" style="background: linear-gradient(135deg, {{ $gradient }}, {{ $gradient2 }});">
                    <div class="icon">{!! $produit->emoji !!}</div>
                    <h3>{{ $produit->nom }}</h3>

                    <p><i class="fas fa-dollar-sign"></i> Prix payé : 
                        <span class="prix" data-usdt="{{ $produit->pivot->prix }}"></span>
                    </p>
                    <p><i class="fas fa-calendar-day"></i> Durée : 
                        <span>{{ $produit->pivot->duree }} jours</span>
                    </p>
                    <p><i class="fas fa-chart-line"></i> Revenu attendu : 
                        <span class="revenu" data-usdt="{{ $produit->pivot->revenu }}"></span>
                    </p>
                    <p><i class="fas fa-clock"></i> Date d’achat : 
                        {{ $produit->pivot->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
.produit-container { max-width: 1200px; margin: 0 auto; padding: 40px 20px; text-align: center; }
.produit-title { font-size: 2.2rem; font-weight: 800; margin-bottom: 40px; color: #222; }

.crypto-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 25px; }

.crypto-card {
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
}
.crypto-card:hover { transform: translateY(-8px); box-shadow: 0 12px 30px rgba(0,0,0,0.15); }
.crypto-card .icon { font-size: 3rem; margin-bottom: 15px; }
.crypto-card h3 { font-size: 1.5rem; margin-bottom: 15px; font-weight: 700; color: #111; }
.crypto-card p { margin: 6px 0; font-size: 1rem; color: #555; }
.crypto-card p i { color: #0e1577; margin-right: 6px; }
.crypto-card span { font-weight: 600; color: #000; }
.crypto-card .revenu { color: #16a34a; font-weight: 700; }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const taux = 600;

    function formatNombre(n) {
        return Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    }

    document.querySelectorAll(".prix, .revenu").forEach(el => {
        const usdt = parseFloat(el.getAttribute("data-usdt")) || 0;
        const fcfa = usdt * taux;
        el.innerHTML = `${formatNombre(fcfa)} FCFA (≈ ${usdt} USDT)`;
    });
});
</script>
@endsection
