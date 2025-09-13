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

    /* Informations utilisateur */
    .user-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .user-info div {
        background: linear-gradient(135deg, #f9fafc, #eef2f7);
        padding: 15px;
        border-radius: 12px;
        border: 1px solid #e0e6ed;
        font-size: 15px;
        color: #34495e;
    }

    .user-info div strong {
        color: #1a73e8;
    }

    /* Solde mis en avant */
    .balance-card {
        grid-column: span 2;
        text-align: center;
        background: linear-gradient(135deg, #1a73e8, #4a90e2);
        color: orange !important;
        font-size: 22px;
        font-weight: bold;
        padding: 25px;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(26,115,232,0.3);
    }

    /* Options */
    .options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .option-card {
        background: #fff;
        padding: 20px;
        border-radius: 14px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px solid #e0e6ed;
        font-weight: 500;
        color: #2c3e50;
    }

    .option-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        border-color: #1a73e8;
        color: #1a73e8;
    }
    .contact{
        width: 90%;
    }

    @media (max-width: 768px) {
        .balance-card {
            grid-column: span 1;
        }
    }
</style>

<div class="moi-container">
    <div class="moi-header"> Mon Profil</div>

    <div class="user-info">
        <div><strong>Nom :</strong> {{ $user->name }}</div>
        <div><strong>Email :</strong> {{ $user->email }}</div>
        <div><strong>Téléphone :</strong> {{ $user->phone ?? 'Non renseigné' }}</div>
        <div><strong>Pays :</strong> {{ $user->country ?? 'Non renseigné' }}</div>

        <!-- Solde en avant -->
        <div class="balance-card">
             Solde : {{ number_format($user->balance ?? 0, 0, ',', ' ') }} $
        </div>
    </div>

    <div class="options">
        <a href="{{ route('user.edit') }}" style="color: inherit; text-decoration: none;">
            <div class="option-card">
                Modifier mes informations
            </div>
        </a>
        <a href="{{ route('depots.index') }}">
            <div class="option-card"> Historique de mes dépôts</div>
        </a>
        <a href="{{ route('retraits.index') }}">
            <div class="option-card"> Historique de mes retraits</div>
        </a>
        
        <div class="option-card">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="background:none;border:none;color:#3a8dff;cursor:pointer;">
                    Déconnexion
                </button>
            </form>
        </div>
         <a href="{{ route('contact') }}">
            <div class="option-card contact"> Contactez le support</div>
        </a>
    </div>

</div>
@endsection
