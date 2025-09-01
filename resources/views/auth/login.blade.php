@extends('layouts.guest')

@section('content')

<style>
body {
    background-color: #121212;
    font-family: Arial, sans-serif;
    color: #e0e0e0;
}

.auth-container {
    max-width: 400px;
    margin: 60px auto;
    padding: 30px;
    background-color: #1f1f2e;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.5);
}

.auth-container h1 {
    text-align: center;
    color: #ff9800;
    margin-bottom: 25px;
    font-size: 2rem;
}

.auth-container input {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #333;
    background-color: #2b2b3c;
    color: #e0e0e0;
    font-size: 16px;
    transition: border 0.3s, background 0.3s;
}

.auth-container input:focus {
    border-color: #3a8dff;
    background-color: #333;
    outline: none;
}

.auth-container button {
    width: 100%;
    padding: 12px;
    background-color: #3a8dff;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: background 0.3s, transform 0.2s;
}

.auth-container button:hover {
    background-color: #2865c2;
    transform: scale(1.02);
}

.auth-container .links {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}

.auth-container .links a {
    color: #3a8dff;
    text-decoration: none;
    transition: color 0.3s;
}

.auth-container .links a:hover {
    color: #ff9800;
    text-decoration: underline;
}

/* Optionnel : erreurs de validation */
.auth-container .error {
    background-color: #ff4d4f;
    color: #fff;
    padding: 8px 12px;
    border-radius: 6px;
    margin-bottom: 12px;
    font-size: 14px;
    text-align: center;
}
</style>

<div class="auth-container">
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
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>

    <div class="links">
        <a href="{{ route('register') }}">Pas de compte ? Inscrivez-vous</a>
    </div>
</div>

@endsection
