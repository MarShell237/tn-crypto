@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="profile-container">
    <div class="profile-card">
        <h2>👤 Mon Profil</h2>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <!-- Formulaire de modification -->
        <form action="{{ route('profile.update') }}" method="POST" class="profile-form">
            @csrf
            <label>Nom :</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

            <label>Email :</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

            <label>Mot de passe (laisser vide si inchangé) :</label>
            <input type="password" name="password">
            <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe">

            <button type="submit">💾 Mettre à jour</button>
        </form>
    </div>

    <div class="profile-card wins-card">
        <h2>🏆 Historique de mes gains</h2>
        @if($wins->isEmpty())
            <p>Aucun gain enregistré.</p>
        @else
            <table class="wins-table">
                <thead>
                    <tr>
                        <th>Récompense</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wins as $win)
                        <tr>
                            <td>{{ $win->reward }}</td>
                            <td>{{ $win->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<style>
.profile-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
    padding: 40px 15px;
}
.profile-card {
    background: #1e1e2f;
    color: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}
.profile-card h2 { margin-bottom: 20px; text-align: center; }
.profile-form { display: flex; flex-direction: column; gap: 15px; }
.profile-form input {
    padding: 10px;
    border-radius: 8px;
    border: none;
    outline: none;
}
.profile-form button {
    background: #3a8dff;
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
}
.profile-form button:hover { background: #0d6efd; }

.alert-success {
    background: #28a745;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
    text-align: center;
}

.wins-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}
.wins-table th, .wins-table td {
    padding: 10px;
    border-bottom: 1px solid #444;
    text-align: left;
}
.wins-table th { background: #2c2c3d; }
</style>
@endsection
