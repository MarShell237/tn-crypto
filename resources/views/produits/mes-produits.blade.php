@extends('layouts.app')

@section('title', 'Produits Crypto')

@section('content')
<div class="produit-container">
    <h2 class="produit-title"><i class="fas fa-coins"></i> Nos Produits Crypto</h2>

    <div class="crypto-grid">
        @foreach($produits as $produit)
        <div class="crypto-card" data-id="{{ $produit->id }}" style="background: {{ $produit->bg_color ?? '#fff' }}">
            <div class="icon">{!! $produit->icon !!}</div>
            <h3>{{ $produit->nom }}</h3>
            <p><i class="fas fa-dollar-sign"></i> Prix d’achat : 
                <span class="prix" data-usdt="{{ $produit->prix_usdt }}"></span>
            </p>
            <p><i class="fas fa-calendar-day"></i> Validité : <span>{{ $produit->duree }}</span></p>
            <p><i class="fas fa-chart-line"></i> Revenu total : 
                <span class="revenu" data-usdt="{{ $produit->revenu_usdt }}"></span>
            </p>
            <button class="acheter"><i class="fas fa-shopping-cart"></i> Acheter</button>
        </div>
        @endforeach
    </div>

    <h2 class="produit-title" style="margin-top:50px;"><i class="fas fa-box-open"></i> Mes Produits</h2>
    <div class="produits-grid">
        @foreach(auth()->user()->produits as $p)
        <div class="crypto-card" style="background:#f0f0f0;">
            <h3>{{ $p->nom }}</h3>
            <p><i class="fas fa-dollar-sign"></i> Prix : <span>{{ number_format($p->pivot->prix ?? $p->prix_usdt * 600, 0, ',', ' ') }} FCFA</span></p>
            <p><i class="fas fa-calendar-day"></i> Validité : <span>{{ $p->pivot->duree ?? $p->duree }}</span></p>
            <p><i class="fas fa-chart-line"></i> Revenu total : <span>{{ number_format($p->pivot->revenu ?? $p->revenu_usdt * 600, 0, ',', ' ') }} FCFA</span></p>
        </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div id="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
        <div style="background:#fff; padding:30px; border-radius:12px; max-width:400px; text-align:center;">
            <p id="modal-message" style="font-size:18px; font-weight:bold;"></p>
            <button id="modal-close" style="margin-top:20px; padding:10px 20px; border:none; border-radius:8px; background:#0e1577; color:#fff; cursor:pointer;">Fermer</button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const taux = 600; // 1 USDT = 600 FCFA

    function formatNombre(n) {
        return Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    }

    // Convertir les prix
    document.querySelectorAll(".prix, .revenu").forEach(el => {
        const usdt = parseFloat(el.getAttribute("data-usdt")) || 0;
        const fcfa = usdt * taux;
        el.innerHTML = `${formatNombre(fcfa)} FCFA (≈ ${usdt} USDT)`;
        el.setAttribute("data-fcfa", fcfa);
    });

    const modal = document.getElementById("modal");
    const modalMsg = document.getElementById("modal-message");

    // Gestion de l'achat
    document.querySelectorAll(".acheter").forEach(button => {
        button.addEventListener("click", function() {
            const card = this.closest(".crypto-card");
            const nom = card.querySelector("h3").innerText;
            const prixFcfa = parseFloat(card.querySelector(".prix").getAttribute("data-fcfa"));
            const duree = card.querySelector("p span").innerText;
            const revenu = parseFloat(card.querySelector(".revenu").getAttribute("data-fcfa"));
            const id = card.dataset.id;

            fetch("{{ route('acheter.crypto') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ id, nom, prix_fcfa: prixFcfa, duree, revenu })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    // Modal succès
                    modalMsg.innerHTML = '<i class="fas fa-check-circle" style="color:green"></i> Achat effectué avec succès !';
                    modal.style.display = "flex";

                    // Ajouter dynamiquement dans Mes Produits
                    const produitsGrid = document.querySelector(".produits-grid");
                    const nouveauProduit = document.createElement("div");
                    nouveauProduit.classList.add("crypto-card");
                    nouveauProduit.style.background = "#f0f0f0";
                    nouveauProduit.style.padding = "20px";
                    nouveauProduit.style.borderRadius = "12px";
                    nouveauProduit.style.boxShadow = "0 4px 15px rgba(0,0,0,0.08)";
                    nouveauProduit.innerHTML = `
                        <h3>${data.produit.nom}</h3>
                        <p><i class="fas fa-dollar-sign"></i> Prix : <span>${formatNombre(data.produit.prix)} FCFA</span></p>
                        <p><i class="fas fa-calendar-day"></i> Validité : <span>${data.produit.duree}</span></p>
                        <p><i class="fas fa-chart-line"></i> Revenu total : <span>${formatNombre(data.produit.revenu)}</span></p>
                    `;
                    produitsGrid.appendChild(nouveauProduit);

                    // Mettre à jour solde
                    const soldeEl = document.getElementById("solde");
                    if(soldeEl) soldeEl.innerText = Math.round(data.nouveau_solde).toLocaleString('fr-FR') + " FCFA";
                } else {
                    modalMsg.innerHTML = '<i class="fas fa-times-circle" style="color:red"></i> Solde insuffisant !';
                    modal.style.display = "flex";
                }
            });
        });
    });

    document.getElementById("modal-close").onclick = () => modal.style.display = "none";
});
</script>
@endsection
