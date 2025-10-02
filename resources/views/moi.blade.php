@extends('layouts.app')

@section('content')
<style>
body {
    background: #f5f7fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.moi-container {
    max-width: 900px;
    margin: 40px auto;
    background: #fff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.moi-header {
    text-align: center;
    margin-bottom: 30px;
    font-size: 28px;
    font-weight: bold;
    color: #2c3e50;
}

/* Row / Column */
.row {
    display: flex;
    flex-wrap: wrap;
    margin: -10px;
}

.col {
    padding: 10px;
    flex: 1 1 0; /* base pour s'adapter */
    min-width: 250px; /* largeur minimale des colonnes */
}

/* Cartes utilisateur et solde */
.user-card, .balance-card, .option-card {
    background: linear-gradient(135deg, #f9fafc, #eef2f7);
    border-radius: 12px;
    border: 1px solid #e0e6ed;
    padding: 15px;
    color: #34495e;
    font-size: 15px;
}

.user-card strong {
    color: #1a73e8;
}

/* Solde */
.balance-card {
    background: linear-gradient(135deg, #1a73e8, #4a90e2);
    color: orange !important;
    font-size: 22px;
    font-weight: bold;
    text-align: center;
    padding: 25px;
    box-shadow: 0 6px 20px rgba(26,115,232,0.3);
}

/* Options */
.option-card {
    background: #fff;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 1px solid #e0e6ed;
    font-weight: 500;
    color: #2c3e50;
    padding: 20px;
    border-radius: 14px;
}

.option-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    border-color: #1a73e8;
    color: #1a73e8;
}

.option-card button {
    background: none;
    border: none;
    color: #3a8dff;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
}

/* Responsiveness */
@media (max-width: 768px) {
    .col {
        flex: 0 0 50%; /* 2 colonnes */
        max-width: 50%;
    }
}

@media (max-width: 480px) {
    .col {
        flex: 0 0 100%; /* 1 colonne */
        max-width: 100%;
    }
}
</style>

<div class="moi-container">
    <div class="moi-header">Mon Profil</div>

    <!-- Infos utilisateur -->
    <div class="row">
        <div class="col"><div class="user-card"><strong>Nom :</strong> {{ $user->name }}</div></div>
        <div class="col"><div class="user-card"><strong>Email :</strong> {{ $user->email }}</div></div>
        <div class="col"><div class="user-card"><strong>Téléphone :</strong> {{ $user->phone ?? 'Non renseigné' }}</div></div>
        <div class="col"><div class="user-card"><strong>Pays :</strong> {{ $user->country ?? 'Non renseigné' }}</div></div>
        <div class="col" style="flex: 1 1 100%;"><div class="balance-card">Solde : {{ number_format($user->balance ?? 0, 0, ',', ' ') }} $</div></div>
    </div>

    <!-- Options -->
    <div class="row">
        <div class="col"><a href="{{ route('user.edit') }}" style="text-decoration:none;"><div class="option-card">Modifier mes informations</div></a></div>
        <div class="col"><a href="{{ route('depots.index') }}" style="text-decoration:none;"><div class="option-card">Historique de mes dépôts</div></a></div>
        <div class="col"><a href="/withdrawals/history" style="text-decoration:none;"><div class="option-card">Historique de mes retraits</div></a></div>
        <div class="col"><div class="option-card">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Déconnexion</button>
            </form>
        </div></div>
        <div class="col" style="flex: 1 1 100%;"><a href="{{ route('contact') }}" style="text-decoration:none;"><div class="option-card">Contactez le support</div></a></div>
    </div>
</div>
@endsection
