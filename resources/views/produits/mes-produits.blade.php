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

                $canClaim = $produit->can_claim ?? true;
                $nextIso = $produit->next_available_at ?? '';
            @endphp

            <div class="crypto-card" style="background: linear-gradient(135deg, {{ $gradient }}, {{ $gradient2 }});">
                <div class="icon">{!! $produit->emoji !!}</div>
                <h3>{{ $produit->nom }}</h3>

                <p><i class="fas fa-dollar-sign"></i> Prix d’achat :
                    <span>{{ number_format($produit->pivot->prix, 2, ',', ' ') }} FCFA</span>
                </p>

                <p><i class="fas fa-calendar-day"></i> Validité :
                    <span>{{ $produit->pivot->duree }} jours</span>
                </p>

                <p><i class="fas fa-chart-line"></i> Revenu par gain :
                    <span class="revenu">{{ number_format($produit->pivot->revenu, 2, ',', ' ') }} FCFA</span>
                </p>

                {{-- Bouton Réclamation --}}
                <form method="POST" action="{{ route('produits.claim', $produit->id) }}">
                    @csrf
                    <button 
                        type="submit"
                        id="btn-gain-{{ $produit->id }}"
                        class="btn-gain"
                        style="background: {{ $buttonColor }}; color:white; padding:10px 18px; border:none; border-radius:8px; cursor:pointer; font-weight:bold;"
                        {{ $canClaim ? '' : 'disabled' }}>
                        {{ $canClaim ? '🎁 Réclamer mon gain' : '⏳ Déjà réclamé, revenez bientôt' }}
                    </button>
                </form>

                <p id="timer-{{ $produit->id }}" class="timer" style="margin-top:10px; font-weight:bold; color:#555;">
                    @if(!$canClaim)
                        ⏱ Disponible dans <span class="countdown" data-next="{{ $nextIso }}"></span>
                    @endif
                </p>
            </div>
        @endforeach
    </div>
</div>

{{-- ----------------- CSS ----------------- --}}
<style>
.produit-container {
    width: auto;
    margin: 0 auto;
    padding: 10px;
    text-align: center;
}
.produit-title {
    font-size: 2.3rem;
    font-weight: 800;
    margin-bottom: 40px;
    color: #222;
}
.crypto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    gap: 25px;
}
.crypto-card {
    border-radius: 20px;
    padding: 20px 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: transform .3s;
    text-align: center;
}
.crypto-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}
.icon { font-size: 3rem; margin-bottom: 15px; }
h3 { font-size: 1.5rem; font-weight: 700; color: #111; margin-bottom: 15px; }
p { margin: 6px 0; font-size: .95rem; color: #555; }
.revenu { color: #16a34a; font-weight: 700; }
.btn-gain { margin-top: 10px; transition: .2s; }
.btn-gain:hover:enabled { transform: scale(1.04); }
.btn-gain:disabled { cursor: not-allowed; opacity: .6; }
.timer { font-size: .9rem; }
</style>

{{-- ----------------- SCRIPT JS (timer backend) ----------------- --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.countdown').forEach(function(timer) {
        const nextIso = timer.dataset.next;
        const card = timer.closest('.crypto-card');
        const button = card.querySelector('button');

        if (!nextIso) return;

        const nextTs = Date.parse(nextIso);

        const updateTimer = () => {
            const now = Date.now();
            let diff = nextTs - now;

            if (diff <= 0) {
                timer.textContent = '✅ Gain disponible !';
                button.disabled = false;
                button.textContent = '🎁 Réclamer mon gain';
                return;
            }

            const totalSeconds = Math.floor(diff / 1000);
            const days = Math.floor(totalSeconds / 86400);
            const hours = Math.floor((totalSeconds % 86400) / 3600);
            const minutes = Math.floor((totalSeconds % 3600) / 60);
            const seconds = totalSeconds % 60;

            let text = '';
            if (days > 0) text += `${days}j `;
            if (hours > 0 || days > 0) text += `${hours}h `;
            text += `${minutes}m ${seconds}s`;

            timer.textContent = text;
            setTimeout(updateTimer, 1000);
        };

        updateTimer();
    });
});
</script>
@endsection
