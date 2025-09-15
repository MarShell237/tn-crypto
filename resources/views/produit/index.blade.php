@extends('layouts.app')

@section('title', 'Nos Produits Crypto')

@section('content')
<div class="produit-container">
    <h2 class="produit-title"><i class="fas fa-coins"></i> Nos Produits Crypto</h2>

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
                $buttonColor = $colors[$produit->nom][2] ?? '#0e1577';
            @endphp

           <div class="crypto-card" style="background: linear-gradient(135deg, {{ $gradient }}, {{ $gradient2 }});">
    <div class="icon">{!! $produit->emoji !!}</div>
    <h3>{{ $produit->nom }}</h3>

    <p>
        <i class="fas fa-dollar-sign"></i> Prix d’achat : 
        <span class="prix" data-usdt="{{ $produit->prix }}">
            {{ number_format($produit->prix, 2, ',', ' ') }} FCFA
        </span>
    </p>

    <p>
        <i class="fas fa-calendar-day"></i> Validité : 
        <span>{{ $produit->duree }} jours</span>
    </p>

    <p>
        <i class="fas fa-chart-line"></i> Revenu journalier : 
        <span class="revenu" data-usdt="{{ $produit->revenu_journalier }}">
            {{ number_format($produit->revenu_journalier, 2, ',', ' ') }} FCFA
        </span>
    </p>

    <p>
        <i class="fas fa-chart-line"></i> Revenu total : 
        <span class="revenu" data-usdt="{{ $produit->revenu }}">
            {{ number_format($produit->revenu, 2, ',', ' ') }} FCFA
        </span>
    </p>

    <button class="acheter" data-id="{{ $produit->id }}" style="background: {{ $buttonColor }};">
        <i class="fas fa-shopping-cart"></i> Acheter
    </button>
</div>

        @endforeach
    </div>

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <p id="modal-message"></p>
            <button id="modal-close">Fermer</button>
        </div>
    </div>
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
    transform: scale(0.9);
}
.crypto-card:hover { transform: translateY(-8px); box-shadow: 0 12px 30px rgba(0,0,0,0.15); }
.crypto-card .icon { font-size: 3rem; margin-bottom: 15px; }
.crypto-card h3 { font-size: 1.5rem; margin-bottom: 15px; font-weight: 700; color: #111; }
.crypto-card p { margin: 6px 0; font-size: 1rem; color: #555; }
.crypto-card p i { color: #0e1577; margin-right: 6px; }
.crypto-card span { font-weight: 600; color: #000; }
.crypto-card .revenu { color: #16a34a; font-weight: 700; }

.crypto-card button {
    margin-top: 15px;
    padding: 12px 25px;
    border: none;
    border-radius: 30px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    color: #fff;
    transition: transform 0.2s ease, filter 0.2s ease;
}
.crypto-card button:hover { transform: scale(1.05); filter: brightness(90%); }

.modal {
    display: none;
    position: fixed;
    top:0; left:0; width:100%; height:100%;
    background: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
.modal-content {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    max-width: 400px;
    text-align: center;
}
#modal-close {
    margin-top: 20px;
    padding: 10px 20px;
    border:none;
    border-radius:8px;
    background:#0e1577;
    color:#fff;
    cursor:pointer;
}
#modal-close:hover { background: #161f8f; }
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
        el.setAttribute("data-fcfa", fcfa);
    });

    const modal = document.getElementById("modal");
    const modalMsg = document.getElementById("modal-message");
    const modalClose = document.getElementById("modal-close");
    modalClose.onclick = () => modal.style.display = "none";

    document.querySelectorAll(".acheter").forEach(button => {
        button.addEventListener("click", function() {
            const card = this.closest(".crypto-card");
            const nom = card.querySelector("h3").innerText;
            const prixFcfa = parseFloat(card.querySelector(".prix").getAttribute("data-fcfa"));
            const duree = card.querySelector("p span").innerText;
            const revenu = parseFloat(card.querySelector(".revenu").getAttribute("data-fcfa"));

            fetch("{{ route('acheter.crypto') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ prix_fcfa: prixFcfa, nom: nom, duree: duree, revenu: revenu })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    modalMsg.innerHTML = '<i class="fas fa-check-circle" style="color:green;"></i> Paiement effectué !';
                    modal.style.display = "flex";
                } else {
                    modalMsg.innerHTML = '<i class="fas fa-times-circle" style="color:red;"></i> Solde insuffisant !';
                    modal.style.display = "flex";
                }
            });
        });
    });
});
</script>
@endsection
