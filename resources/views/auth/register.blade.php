@extends('layouts.guest')

@section('content')

<style>
/* ---- STRUCTURE GÉNÉRALE ---- */
form {
    width: 100%;
    max-width: 360px;
    margin: 0 auto;
}

h1 {
    text-align: center;
    color: #1f2d3d;
    margin-bottom: 25px;
    font-size: 1.7rem;
    font-weight: 700;
}

/* ---- CHAMPS ---- */
input,
select {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 14px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    background-color: #fafafa;
    font-size: 15px;
    transition: all 0.2s ease-in-out;
    box-sizing: border-box;
}

input:focus,
select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 4px rgba(37,99,235,0.4);
    outline: none;
}

/* ---- BOUTON ---- */
button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.2s ease, background 0.2s ease;
}

button:hover {
    transform: translateY(-1px);
    background: linear-gradient(135deg, #1d4ed8, #1e40af);
}

/* ---- ERREURS ---- */
.error {
    background-color: #dc2626;
    color: white;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
    font-size: 0.9rem;
}

/* ---- LIENS ---- */
.links {
    text-align: center;
    margin-top: 15px;
}

.links a {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
}

.links a:hover {
    color: #1e40af;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 480px) {
    form {
        width: 90%;
    }

    h1 {
        font-size: 1.4rem;
    }

    input,
    select,
    button {
        font-size: 14px;
    }
}
</style>

<h1>Créer un compte</h1>

@if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="text" name="name" placeholder="Nom complet" value="{{ old('name') }}" required>

    <select name="country" required>
        <option value="">Sélectionnez votre pays</option>
        @foreach(\App\Helpers\Countries::list() as $country)
            <option value="{{ $country }}" {{ old('country') == $country ? 'selected' : '' }}>
                {{ $country }}
            </option>
        @endforeach
    </select>

    <input type="email" name="email" placeholder="Adresse e-mail" value="{{ old('email') }}" required>
    <input type="text" name="phone" placeholder="Numéro de téléphone" value="{{ old('phone') }}" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <input type="password" name="password_confirmation" placeholder="Confirmez le mot de passe" required>
    <input type="text" name="referral_code" placeholder="Code de parrainage (optionnel)" value="{{ old('referral_code') }}">

    <button type="submit">S'inscrire</button>
</form>

<div class="links">
    <a href="{{ route('login') }}">Déjà inscrit ? Se connecter</a>
</div>

@endsection
