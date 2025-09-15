@extends('layouts.app')

@section('content')
<h2>Modifier l'utilisateur</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nom :</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}"><br>

    <label>Email :</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}"><br>

    <label>Phone :</label>
    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"><br>

    <label>Pays :</label>
    <input type="text" name="country" value="{{ old('country', $user->country) }}"><br>

    <label>Balance :</label>
    <input type="number" name="balance" value="{{ old('balance', $user->balance) }}" step="0.01"><br>

    <button type="submit">Enregistrer</button>
</form>

<a href="{{ route('admin.users.index') }}">Retour</a>
@endsection
