@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Modal Bienvenue -->
<div id="welcomeModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <div class="modal-header">
            <i class="fab fa-bitcoin big-icon" style="color:#F7931A;"></i>
            <h2>Bienvenue sur InvestPro</h2>
        </div>
        <p class="welcome-text">
            Nous sommes ravis de vous accueillir dans votre espace d’investissement sécurisé.  
            Voici un bref aperçu de notre plateforme :
        </p>
        <ul class="platform-brief">
            <li><i class="fas fa-gift"></i> Bonus d'inscription : <b>1000 FCFA</b></li>
            <li><i class="fas fa-user-friends"></i> Invitez vos amis et recevez <b>20 % de leur investissement</b></li>
            <li><i class="fas fa-wallet"></i> Un retrait possible <b>chaque jour</b></li>
            <li><i class="fas fa-globe"></i> CryptoInvest sera lancé au <b>Cameroun, Bénin et Burkina Faso le 31 août 2025</b></li>
        </ul>
        <button class="modal-btn" onclick="closeModal()">Commencer</button>
    </div>
</div>

<!-- Carrousel -->
<div class="carousel">
    <div class="carousel-slide active">
        <img src="{{ asset('IMAGES/carsoussels/img1.jpeg') }}" alt="Slide 1">
    </div>
    <div class="carousel-slide">
        <img src="{{ asset('IMAGES/carsoussels/img2.jpeg') }}" alt="Slide 2">
    </div>
    <div class="carousel-slide">
        <img src="{{ asset('IMAGES/carsoussels/img3.jpeg') }}" alt="Slide 3">
    </div>

    <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
    <button class="next" onclick="changeSlide(1)">&#10095;</button>
</div>

<!-- Marquee -->
<div class="marquee">
    <p>Bienvenue sur votre dashboard InvestPro. Gérez vos dépôts, retraits et produits facilement !</p>
</div>

<!-- Blocs de fonctionnalités -->
<div class="features">
    @auth
    @if(auth()->user()->is_admin) 
    <div class="feature-row">
        <div class="feature-card">
            <h1>Admin Dashboard</h1>
            <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>  
        </div>    
    </div>
    @endif
    @endauth

    <div class="feature-row">
        <div class="feature-card amount">
            <h3><i class="fas fa-dollar-sign icon-card"></i> Montant</h3>
            <p>$0.00</p>
        </div>
        <div class="feature-card total">
            <h3><i class="fas fa-university icon-card"></i> Compte total</h3>
            <p style="color: #F7931A; font-weight: bold;">{{ number_format(auth()->user()->balance ?? 0, 3, ',', ' ') }} FCFA</p>
        </div>
    </div>

    <div class="feature-row">
        <div class="feature-card deposit">
            <h3><i class="fas fa-arrow-down icon-card"></i> Dépôt</h3>
            <a href="{{ route('depot.create') }}"><button>Faire un dépôt</button></a>
        </div>
        <div class="feature-card withdraw">
            <h3><i class="fas fa-arrow-up icon-card"></i> Retrait</h3>
            <a href="{{ route('withdrawals.create') }}"><button>Faire un retrait</button></a>
        </div>
    </div>

    <div class="feature-row">
        <a class="feature-card product" href="/produit/index">
            <div class="feature-card product">
                <h3><i class="fas fa-box-open icon-card"></i> Produits</h3>
                <p>Voir les produits</p>
            </div>
        </a>
        <a class="minages_a feature-card" href="/withdrawals/history">
            <div class="feature-card minages">
                <h3><i class="fas fa-cogs icon-card"></i> Historiques</h3>
                <p>Consulter l'historique de vos retraits</p>
            </div>
        </a>
        <a class="feature-card" href="{{ route('partenaire.index') }}">
            <div class="feature-card partenaires">
                <h3><i class="fas fa-handshake icon-card"></i> Partenaires</h3>
                <p>Devenez partenaires et gagnez plus gros</p>
            </div>
        </a>
        <a class="feature-card" href="{{ route('bonus.use') }}">
            <div class="feature-card bonus">
                <h3><i class="fas fa-gift icon-card"></i> Bonus</h3>
                <p>Voir les bonus</p>
            </div>
        </a>
    </div>

    <a class="product_responsive" href="produits/mes-produits">
        <div class="feature-row product_responsive">
            <div class="feature-card">
                <h3><i class="fas fa-archive icon-card"></i> Mes Produits</h3>
                <p>Mes produits achetés</p>
            </div>
        </div>
    </a>
</div>

<!-- Styles -->
<style>
/* Global */
body { background-color: #f4f6f8; font-family: 'Poppins', Arial, sans-serif; color: #333; margin: 0; padding: 0; }

/* Carrousel */
.carousel { position: relative; width: 100%; max-width: 1200px; height: 350px; margin: 20px auto; overflow: hidden; border-radius: 15px; box-shadow: 0 6px 20px rgba(0,0,0,0.1); display:none; }
.carousel-slide { position: absolute; top: 0; left: 100%; width: 100%; height: 100%; opacity: 0; transition: all 0.8s ease-in-out; }
.carousel-slide.active { left: 0; opacity: 1; }
.carousel-slide img { width: 100%; height: 100%; object-fit: cover; border-radius: 15px; }
.prev, .next { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255,165,0,0.8); color: #fff; border: none; padding: 12px 18px; cursor: pointer; border-radius: 50%; font-size: 20px; transition: all 0.3s ease; z-index: 2; }
.prev:hover, .next:hover { background: rgba(255,140,0,0.9); transform: scale(1.1); }
.prev { left: 15px; } .next { right: 15px; }

/* Marquee */
.marquee { background: #e0e4e8; color: #333; overflow: hidden; white-space: nowrap; padding: 12px 0; margin: 20px auto; max-width: 1200px; border-radius: 10px; }
.marquee p { display: inline-block; padding-left: 100%; animation: marquee 15s linear infinite; font-weight: 500; }
@keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-100%); } }

/* Features */
.features { max-width: 1200px; margin: 30px auto; display: flex; flex-direction: column; gap: 25px; }
.feature-row { display: flex; gap: 20px; flex-wrap: wrap; }
.feature-card { flex: 1; min-width: 130px; padding: 25px 20px; border-radius: 15px; text-align: center; color: #333; box-shadow: 0 6px 18px rgba(0,0,0,0.08); transition: transform 0.3s, box-shadow 0.3s; }
.minages_a{ width: 39%; }
.feature-card h3 { margin-bottom: 10px; font-size: 18px; }
.feature-card p { font-size: 16px; }
.feature-card button { margin-top: 10px; padding: 10px 20px; border: none; border-radius: 8px; background:  #F7931A; color: #fff; font-weight: 600; cursor: pointer; transition: all 0.3s; }
.feature-card button:hover { background:  #F7931A; transform: scale(1.05); }
.feature-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.15); }
.feature-card:not(.bonus) { background: #0e1577ff; color: #fff; }
.feature-card.bonus { background: #0e1577ff; color: #fff; }

/* Modal */
.modal { display: flex; align-items: center; justify-content: center; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 80%; background: rgba(0,0,0,0.6); animation: fadeIn 1s; }
.modal-content { background: #fff; border-radius: 15px; max-width: 400px; width: 70%; padding: 10px; text-align: center; position: relative; animation: slideDown 0.5s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
.big-icon { font-size: 3.5rem; margin-bottom: 15px; color:#F7931A; }
.welcome-text { font-size: 1rem; margin-bottom: 20px; color: #444; }
.platform-brief { list-style: none; padding: 0; margin: 0 0 20px; text-align: left; }
.platform-brief li { font-size: 1rem; padding: 8px 0; border-bottom: 1px solid #eee; }
.platform-brief i { color: #0e1577; margin-right: 10px; }
.modal-btn { padding: 12px 25px; background: #F7931A; color: #fff; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: background 0.3s; }
.modal-btn:hover { background:  #f7941ad3; }
.close-btn { position: absolute; top: 12px; right: 18px; font-size: 1.5rem; cursor: pointer; color: #888; transition: color 0.3s; }
.close-btn:hover { color: #000; }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes slideDown { from { transform: translateY(-30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

/* Responsive */
@media (max-width: 1024px) {
    .features { margin: 20px auto; }
    .feature-row { gap: 15px; }
    .feature-card { padding: 10px; font-size: 0.95em; }
    .feature-card button { padding: 8px 16px; font-size: 0.85em; }
}

@media (max-width: 768px) {
    .carousel { height: 200px; display:block; }
    .feature-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; width: 90%; margin-left: auto; margin-right: auto; }
    .feature-card { width: 100%;margin-left: -20px; }
    .feature-row .feature-card:last-child:nth-child(odd) { grid-column: span 2; justify-self: center; }
    .product_responsive { width: 100%; margin-top: -10px; }
    .modal-content { width: 90%; max-width: 350px; padding: 10px; }
    .welcome-text { font-size: 0.9rem; }
    .platform-brief li { font-size: 0.85rem; padding: 6px 0; }
    .marquee p { font-size: 0.85rem; }
}

@media (max-width: 480px) {
    .carousel { height: 150px; }
    .feature-card { padding: 10px; font-size: 0.8em; margin-left: -20px;}
    .feature-card h3 { font-size: 1em; }
    .feature-card p { font-size: 0.75em; }
    .feature-card button { font-size: 0.8em; padding: 6px; }
}
</style>

<!-- JS Carrousel + Modal -->
<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-slide');
function showSlide(index) {
    slides.forEach((s, i) => { s.classList.remove('active'); if(i===index)s.classList.add('active'); });
}
function changeSlide(n) { currentSlide += n; if(currentSlide<0) currentSlide=slides.length-1; if(currentSlide>=slides.length) currentSlide=0; showSlide(currentSlide);}
showSlide(currentSlide);
setInterval(()=>changeSlide(1),5000);

const modal = document.getElementById("welcomeModal");
function closeModal() { modal.style.display = "none"; }
window.onload = ()=> { modal.style.display = "flex"; }
window.addEventListener("click", function(e){ if(e.target===modal) closeModal(); });
</script>

@endsection
