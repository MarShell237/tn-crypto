@extends('layouts.app')

@section('title', 'Minages')

@section('content')
<div class="minage-container">
    <h1>Minages</h1>
    <p class="minage-intro">Investissez dans le minage et générez des revenus passifs avec vos cryptomonnaies.</p>

    <!-- Carte du rendement total -->
    <div class="minage-summary">
        <h2>Rendement total estimé</h2>
        <p class="total-reward">0.00 BTC</p>
    </div>

    <!-- Liste des minages -->
    <div class="minage-list">
        <div class="minage-card">
            <h3>Bitcoin Mining</h3>
            <p>Investissement : 0.01 BTC</p>
            <p>Durée : 30 jours</p>
            <p>Rendement prévu : 0.002 BTC</p>
            <button class="invest-btn">miner</button>
        </div>

        <div class="minage-card">
            <h3>Ethereum Mining</h3>
            <p>Investissement : 0.1 ETH</p>
            <p>Durée : 40 jours</p>
            <p>Rendement prévu : 0.015 ETH</p>
            <button class="invest-btn">miner</button>
        </div>

        <div class="minage-card">
            <h3>Litecoin Mining</h3>
            <p>Investissement : 1 LTC</p>
            <p>Durée : 50 jours</p>
            <p>Rendement prévu : 0.12 LTC</p>
            <button class="invest-btn">miner</button>
        </div>
    </div>
</div>

<style>
.minage-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 20px;
    font-family: 'Poppins', sans-serif;
    text-align: center;
}

.minage-container h1 {
    font-size: 32px;
    color: #0e1577ff;
    margin-bottom: 10px;
}

.minage-intro {
    font-size: 16px;
    color: #555;
    margin-bottom: 30px;
}

.minage-summary {
    background: linear-gradient(90deg, #3a8dff, #0e1577ff);
    color: #fff;
    padding: 25px 20px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    margin-bottom: 40px;
}

.minage-summary h2 {
    font-size: 20px;
    margin-bottom: 15px;
}

.total-reward {
    font-size: 28px;
    font-weight: bold;
}

.minage-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.minage-card {
    background: #fff;
    flex: 1 1 250px;
    max-width: 300px;
    padding: 25px 20px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    text-align: left;
}

.minage-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}

.minage-card h3 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #0e1577ff;
}

.minage-card p {
    font-size: 14px;
    margin-bottom: 8px;
    color: #333;
}

.invest-btn {
    padding: 10px 15px;
    background: linear-gradient(45deg, #ff9800, #ffb74d);
    color: #fff;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}

.invest-btn:hover {
    background: linear-gradient(45deg, #ffb74d, #ff9800);
    transform: scale(1.05);
}

/* Responsive */
@media(max-width: 768px) {
    .minage-list {
        flex-direction: column;
        align-items: center;
    }
}
</style>
@endsection
