@extends('layouts.app')

@section('content')
<h2>Détails de l'utilisateur</h2>

<ul>
    <li>ID : {{ $user->id }}</li>
    <li>Nom : {{ $user->name }}</li>
    <li>Email : {{ $user->email }}</li>
    <li>Phone : {{ $user->phone }}</li>
    <li>Pays : {{ $user->country }}</li>
    <li>Balance : {{ $user->balance }}</li>
    <li>Code parrainage : {{ $user->referral_code }}</li>
    <li>Parrain : {{ $user->referrer ? $user->referrer->name : '-' }}</li>
    <li>Filleuls : {{ $user->referrals->count() }}</li>
    <li>Date d'inscription : {{ $user->created_at->format('d/m/Y H:i') }}</li>
</ul>

<a href="{{ route('admin.users.edit', $user->id) }}">Modifier</a>
<a href="{{ route('admin.users.index') }}">Retour</a>
@endsection
