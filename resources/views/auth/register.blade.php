@extends('layouts.guest')

@section('content')

<style>
body {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}

.auth-container {
    max-width: 420px;
    margin: 60px auto;
    padding: 35px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
}

.auth-container:hover {
    transform: translateY(-4px);
}

.auth-container h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 30px;
    font-size: 2rem;
    font-weight: bold;
}

.auth-container input,
.auth-container select {
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 18px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background-color: #fdfdfd;
    font-size: 15px;
    transition: all 0.3s ease;
}

.auth-container input:focus,
.auth-container select:focus {
    border-color: #3a8dff;
    background-color: #fff;
    box-shadow: 0 0 6px rgba(58,141,255,0.3);
    outline: none;
}

.auth-container button {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #3a8dff, #2865c2);
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: all 0.3s ease;
}

.auth-container button:hover {
    background: linear-gradient(135deg, #2865c2, #1b4b91);
    transform: scale(1.02);
}

.auth-container .links {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
}

.auth-container .links a {
    color: #3a8dff;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.3s;
}

.auth-container .links a:hover {
    color: #ff9800;
}

/* Erreurs validation */
.auth-container .error {
    background-color: #ff4d4f;
    color: #fff;
    padding: 10px 14px;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 14px;
    text-align: left;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}
</style>

<div class="auth-container">
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
        
        <select name="country" id="country" required>
            <option value=""> Sélectionnez votre pays </option>
            @foreach(\App\Helpers\Countries::list() as $country)
                <option value="{{ $country }}" {{ old('country') == $country ? 'selected' : '' }}>{{ $country }}</option>
            @endforeach
        </select>
        @error('country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        
        <input type="email" name="email" placeholder="Adresse e-mail" value="{{ old('email') }}" required>
        
        <input id="phone" type="text" name="phone" placeholder="Numéro de téléphone" value="{{ old('phone') }}" required>
        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="password" name="password_confirmation" placeholder="Confirmez le mot de passe" required>

        <!-- Champ de code de parrainage -->
        <input type="text" name="referral_code" placeholder="Code de parrainage (optionnel)" value="{{ old('referral_code') }}">
        @error('referral_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <button type="submit">S'inscrire</button>
    </form>
    
    <div class="links">
        <a href="{{ route('login') }}">Déjà inscrit ? Se connecter</a>
    </div>
</div>

@endsection
