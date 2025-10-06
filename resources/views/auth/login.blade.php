@extends('layouts.guest')

@section('content')

<style>
/* --- TITRE --- */
h1 {
    text-align: center;
    font-size: 1.9rem;
    font-weight: 700;
    color: #3a3a3a;
    margin-bottom: 25px;
}

/* --- CHAMPS INPUT --- */
input {
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 18px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 15px;
    background: rgba(255,255,255,0.85);
    transition: all 0.3s ease;
    box-sizing: border-box;
}

input:focus {
    border-color: #3a8dff;
    background-color: rgba(255,255,255,0.95);
    outline: none;
    box-shadow: 0 0 6px rgba(58,141,255,0.4);
}

/* --- BOUTON --- */
button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #3a8dff, #1e40af);
    color: white;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

button:hover {
    background: linear-gradient(135deg, #1e40af, #1b326e);
    transform: translateY(-1px);
}

/* --- LIENS --- */
.links {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}

.links a {
    color: #3a8dff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

.links a:hover {
    color: #ff9800;
    text-decoration: underline;
}

/* --- ERREURS --- */
.error {
    background-color: #dc2626;
    color: #fff;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
    font-size: 14px;
    text-align: center;
}

/* --- RESPONSIVE --- */
@media (max-width: 480px) {
    h1 {
        font-size: 1.6rem;
    }
    input, button {
        font-size: 14px;
        padding: 10px;
    }
}
</style>

<h1>Connexion</h1>

@if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" placeholder="Adresse e-mail" value="{{ old('email') }}" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>

<div class="links">
    <a href="{{ route('register') }}">Pas de compte ? Inscrivez-vous</a>
</div>

@endsection
