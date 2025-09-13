@extends('layouts.app')

@section('title', 'Devenir Partenaire')

@section('content')
<div class="partner-container">
    <h1>Devenir Partenaire</h1>
    <p class="partner-intro">Invitez vos amis et gagnez des récompenses !</p>

    <div class="partner-tiers">

        <!-- Palier 1 -->
        <div class="partner-tier">
            <h2>Invitez 5 personnes à investir</h2>
            <p class="reward">Récompense: 1500F</p>
            <div class="progress-bar">
                <div class="progress" style="width: 40%"></div>
            </div>
            <p class="percentage">40% atteint</p>
            <button class="claim-btn" disabled>Réclamer</button>
        </div>

        <!-- Palier 2 -->
        <div class="partner-tier">
            <h2>Invitez 15 personnes à investir</h2>
            <p class="reward">Récompense: 4500F</p>
            <div class="progress-bar">
                <div class="progress" style="width: 20%"></div>
            </div>
            <p class="percentage">20% atteint</p>
            <button class="claim-btn" disabled>Réclamer</button>
        </div>

        <!-- Palier 3 -->
        <div class="partner-tier">
            <h2>Invitez 30 personnes à investir</h2>
            <p class="reward">Récompense: 9000F</p>
            <div class="progress-bar">
                <div class="progress" style="width: 0%"></div>
            </div>
            <p class="percentage">0% atteint</p>
            <button class="claim-btn" disabled>Réclamer</button>
        </div>

        <!-- Palier 4 -->
        <div class="partner-tier">
            <h2>Invitez 60 personnes à investir</h2>
            <p class="reward">Récompense: 18000F</p>
            <div class="progress-bar">
                <div class="progress" style="width: 0%"></div>
            </div>
            <p class="percentage">0% atteint</p>
            <button class="claim-btn" disabled>Réclamer</button>
        </div>

    </div>
</div>

<style>
.partner-container {
    max-width: 900px;
    margin: 50px auto;
    padding: 0 20px;
    font-family: 'Poppins', sans-serif;
    text-align: center;
}

.partner-container h1 {
    font-size: 32px;
    color: #0e1577ff;
    margin-bottom: 10px;
}

.partner-intro {
    font-size: 16px;
    color: #555;
    margin-bottom: 40px;
}

.partner-tiers {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.partner-tier {
    background: #fff;
    flex: 1 1 200px;
    max-width: 220px;
    padding: 25px 20px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

.partner-tier:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}

.partner-tier h2 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #0e1577ff;
}

.reward {
    font-weight: bold;
    margin-bottom: 15px;
    color: #ff9800;
}

.progress-bar {
    width: 100%;
    height: 12px;
    background: #eee;
    border-radius: 10px;
    margin-bottom: 10px;
    overflow: hidden;
}

.progress {
    height: 100%;
    background: linear-gradient(90deg, #0e1577, #3a8dff);
    border-radius: 10px 0 0 10px;
}

.percentage {
    margin-bottom: 15px;
    font-weight: 500;
    color: #555;
}

.claim-btn {
    padding: 10px 15px;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    background: #28a745;
    color: #fff;
    width: 100%;
    transition: all 0.3s;
}

.claim-btn:disabled {
    background: #ccc;
    cursor: not-allowed;
}

.claim-btn:not(:disabled):hover {
    transform: scale(1.05);
}

/* Responsive */
@media(max-width: 768px) {
    .partner-tiers {
        flex-direction: column;
        align-items: center;
    }

    .partner-tier {
        max-width: 100%;
    }
}
</style>

@endsection
