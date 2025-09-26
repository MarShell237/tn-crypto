@extends('layouts.app')

@section('content')
<div class="user-details-container">
    <h2>Détails de l'utilisateur</h2>

    <ul class="user-details-list">
        <li><strong>ID :</strong> {{ $user->id }}</li>
        <li><strong>Nom :</strong> {{ $user->name }}</li>
        <li><strong>Email :</strong> {{ $user->email }}</li>
        <li><strong>Phone :</strong> {{ $user->phone ?? '-' }}</li>
        <li><strong>Pays :</strong> {{ $user->country ?? '-' }}</li>
        <li><strong>Balance :</strong> {{ number_format($user->balance, 2) }} €</li>
        <li><strong>Code parrainage :</strong> {{ $user->referral_code }}</li>
        <li><strong>Parrain :</strong> {{ $user->referrer ? $user->referrer->name : '-' }}</li>
        <li><strong>Filleuls :</strong> {{ $user->referrals->count() }}</li>
        <li><strong>Date d'inscription :</strong> {{ $user->created_at->format('d/m/Y à H:i') }}</li>
        <li><strong>Dernière mise à jour :</strong> {{ $user->updated_at->format('d/m/Y à H:i') }}</li>
    </ul>

    <div class="actions">
        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-edit">Modifier</a>
        <a href="{{ route('admin.users.index') }}" class="btn-back">Retour</a>
    </div>
</div>

<style>
.user-details-container {
    max-width: 700px;
    margin: 40px auto;
    padding: 25px;
    background: #fdfdfd;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    font-family: Arial, sans-serif;
}

.user-details-container h2 {
    text-align: center;
    color: #007BFF;
    margin-bottom: 25px;
}

.user-details-list {
    list-style: none;
    padding: 0;
    font-size: 1em;
}

.user-details-list li {
    padding: 8px 12px;
    border-bottom: 1px solid #ddd;
}

.user-details-list li strong {
    width: 150px;
    display: inline-block;
    color: #007BFF;
}

.actions {
    margin-top: 20px;
    text-align: center;
}

.actions a {
    display: inline-block;
    margin: 0 10px;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.95em;
    transition: background 0.3s;
    color: #fff;
}

.btn-edit {
    background-color: #ffc107;
    color: #212529;
}

.btn-edit:hover {
    background-color: #e0a800;
}

.btn-back {
    background-color: #6c757d;
}

.btn-back:hover {
    background-color: #5a6268;
}
</style>
@endsection
