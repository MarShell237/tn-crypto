@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

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

<!-- Texte défilant -->
<div class="marquee">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.</p>
</div>

<!-- Bloc fonctionnalités -->
<div class="features">

    <!-- Ligne 1 -->
    <div class="feature-row">
        <div class="feature-card amount">
            <h3>Montant</h3>
            <p>$0.00</p>
        </div>
        <div class="feature-card total">
            <h3>Compte total</h3>
            <p>$0.00</p>
        </div>
    </div>

    <!-- Ligne 2 -->
    <div class="feature-row">
        <div class="feature-card deposit">
            <h3>Dépot</h3>
            <button>Faire un dépôt</button>
        </div>
        <div class="feature-card withdraw">
            <h3>Retrait</h3>
            <button>Faire un retrait</button>
        </div>
    </div>

    <!-- Ligne 3 -->
    <div class="feature-row">
        <div class="feature-card product">
            <h3>Produit</h3>
            <p>Voir les produits</p>
        </div>
        <div class="feature-card history">
            <h3>Historique</h3>
            <p>Transactions (dépôts & retraits)</p>
        </div>
        <div class="feature-card bonus">
            <h3>Bonus</h3>
            <p>Voir les bonus</p>
        </div>
    </div>

</div>

<!-- CSS -->
<style>
.carousel {
    position: relative;
    width: 100%;
    max-width: 1200px;
    height: 350px;
    margin: 0 auto 30px;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* Slides */
.carousel-slide {
    position: absolute;
    top: 0;
    left: 100%; /* slide hors écran à droite */
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: all 0.8s ease-in-out; /* transition fluide */
}

.carousel-slide.active {
    left: 0; /* slide visible */
    opacity: 1;
    z-index: 1;
}

.carousel-slide.prev-slide {
    left: -100%; /* slide qui sort à gauche */
    opacity: 0;
    z-index: 0;
}

.carousel-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 15px;
    display: block;
}

/* Boutons navigation */
.prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.6);
    color: #fff;
    border: none;
    padding: 12px 18px;
    cursor: pointer;
    border-radius: 50%;
    font-size: 20px;
    transition: background 0.3s;
}
.prev:hover, .next:hover { background: rgba(0,0,0,0.9); }
.prev { left: 15px; }
.next { right: 15px; }

/* Marquee */
.marquee {
    background: #222;
    color: #fff;
    overflow: hidden;
    white-space: nowrap;
    padding: 12px 0;
    margin-bottom: 30px;
    border-radius: 10px;
}
.marquee p {
    display: inline-block;
    padding-left: 100%;
    animation: marquee 15s linear infinite;
    font-weight: 500;
    font-size: 16px;
}
@keyframes marquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}

/* Features */
.features { display: flex; flex-direction: column; gap: 20px; }
.feature-row { display: flex; gap: 20px; flex-wrap: wrap; }
.feature-card {
    background: #1e1e2f;
    color: #fff;
    flex: 1;
    min-width: 130px;
    padding: 20px;
    text-align: center;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    transition: transform 0.3s, box-shadow 0.3s;
}
.feature-card h3 { margin-bottom: 10px; font-size: 18px; }
.feature-card p { font-size: 16px; }
.feature-card button {
    margin-top: 10px;
    padding: 10px 18px;
    border: none;
    background-color: #ff9800;
    color: #fff;
    font-weight: 600;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}
.feature-card button:hover {
    background-color: #e68900;
    transform: scale(1.05);
}
.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.35);
}

/* Couleurs spécifiques pour certains blocs */
.feature-card.amount { background: #2b2b3c; }
.feature-card.total { background: #2b2b3c; }
.feature-card.deposit { background: #3a8dff; }
.feature-card.withdraw { background: #ff4d4f; }
.feature-card.product { background: #6a5acd; }
.feature-card.history { background: #20c997; } /* anciennement niche */
.feature-card.bonus { background: #ffb100; }

/* Responsive desktop */
@media(min-width: 768px) {
    .feature-row { gap: 25px; }
    .feature-card { flex: 1; }
}
</style>

<!-- JS Carrousel -->
<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-slide');

function showSlide(index) {
    slides.forEach((s, i) => {
        s.classList.remove('active', 'prev-slide');
        if (i === currentSlide) s.classList.add('active');
        else if (i === index) s.classList.add('prev-slide');
    });
}

function changeSlide(n) {
    let nextSlide = currentSlide + n;
    if (nextSlide < 0) nextSlide = slides.length - 1;
    if (nextSlide >= slides.length) nextSlide = 0;

    slides[currentSlide].classList.add('prev-slide'); // slide sort à gauche
    slides[nextSlide].classList.add('active');       // slide entre
    currentSlide = nextSlide;
}

showSlide(currentSlide);
setInterval(() => changeSlide(1), 5000);

</script>

@endsection
