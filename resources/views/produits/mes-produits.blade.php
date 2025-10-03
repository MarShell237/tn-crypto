@extends('layouts.app')

@section('title', 'Mes Produits Crypto')

@section('content')
<div class="produit-container">
    <h2 class="produit-title"><i class="fas fa-coins"></i> Mes Produits Crypto</h2>

    <div class="crypto-grid" id="mes-produits-grid">
        @foreach($produits as $produit)
            @php
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
                $buttonColor = $colors[$produit->nom][2] ?? '#0e1577';

                // Vérification côté serveur pour savoir si le bouton doit être actif
                $lastGain = $produit->pivot->last_gain_at ?? null;
                $canClaim = !$lastGain || now()->diffInHours($lastGain) >= 24;
            @endphp

            <div class="crypto-card" style="background: linear-gradient(135deg, {{ $gradient }}, {{ $gradient2 }});">
                <div class="icon">{!! $produit->emoji !!}</div>
                <h3>{{ $produit->nom }}</h3>

                <p>
                    <i class="fas fa-dollar-sign"></i> Prix d’achat :
                    <span>{{ number_format($produit->pivot->prix, 2, ',', ' ') }} FCFA</span>
                </p>

                <p>
                    <i class="fas fa-calendar-day"></i> Validité :
                    <span>{{ $produit->pivot->duree }} jours</span>
                </p>

                <p>
                    <i class="fas fa-chart-line"></i> Revenu journalier :
                    <span class="revenu">{{ number_format($produit->pivot->revenu, 2, ',', ' ') }} FCFA</span>
                </p>

                {{-- Bouton Gain Journalier sécurisé --}}
                <form method="POST" action="{{ route('produits.claim', $produit->id) }}">
                    @csrf
                    <button 
                        type="submit"
                        class="btn-gain"
                        style="background: {{ $buttonColor }}; color:white; padding:10px 18px; border:none; border-radius:8px; cursor:pointer; font-weight:bold; opacity: {{ $canClaim ? '1' : '0.6' }};"
                        {{ $canClaim ? '' : 'disabled' }}>
                        {{ $canClaim ? '🎁 Réclamer mon gain' : '⏳ Déjà réclamé' }}
                    </button>
                </form>

            </div>
        @endforeach
    </div>
</div>

<style>
/* Container global */
.produit-container {
    width: auto;
    margin: 0 auto;
    padding: 10px 10px;
    text-align: center;
}

/* Titre principal */
.produit-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 50px;
    color: #222;
}

/* Grid responsive */
.crypto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

/* Carte crypto */
.crypto-card {
    border-radius: 20px;
    padding: 20px 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
}
.crypto-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

/* Icone */
.crypto-card .icon {
    font-size: 3.5rem;
    margin-bottom: 20px;
}

/* Nom crypto */
.crypto-card h3 {
    font-size: 1.6rem;
    margin-bottom: 20px;
    font-weight: 700;
    color: #111;
}

/* Paragraphes */
.crypto-card p {
    margin: 8px 0;
    font-size: 1rem;
    color: #555;
}
.crypto-card p i {
    color: #0e1577;
    margin-right: 6px;
}
.crypto-card span {
    font-weight: 600;
    color: #000;
}
.crypto-card .revenu {
    color: #16a34a;
    font-weight: 700;
}

/* Bouton gain */
.btn-gain {
    margin-top: 12px;
    transition: 0.3s;
}
.btn-gain:hover:enabled {
    transform: scale(1.05);
}
.btn-gain:disabled {
    cursor: not-allowed;
}
</style>
@endsection
