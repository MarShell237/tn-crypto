@extends('layouts.app')

@section('content')
<div class="edit-user-container">
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

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="edit-user-form">
        @csrf
        @method('PUT')

        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}">

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">

        <label for="phone">Phone :</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">

        <label for="country">Pays :</label>
        <input type="text" id="country" name="country" value="{{ old('country', $user->country) }}">

        <label for="balance">Balance :</label>
        <input type="number" id="balance" name="balance" value="{{ old('balance', $user->balance) }}" step="0.01">

        <div class="form-actions">
            <button type="submit" class="btn-save">Enregistrer</button>
            <a href="{{ route('admin.users.index') }}" class="btn-back">Retour</a>
        </div>
    </form>
</div>

<style>
.edit-user-container {
    max-width: 600px;
    margin: 40px auto;
    padding: 30px;
    background: #f9f9f9;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    font-family: Arial, sans-serif;
}

.edit-user-container h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #007BFF;
}

.alert {
    background-color: #f8d7da;
    color: #842029;
    padding: 12px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid #f5c2c7;
}

.edit-user-form label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
    color: #333;
}

.edit-user-form input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 1em;
    transition: border-color 0.3s;
}

.edit-user-form input:focus {
    border-color: #007BFF;
    outline: none;
}

.form-actions {
    margin-top: 25px;
    display: flex;
    justify-content: space-between;
}

.btn-save {
    background: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: background 0.3s;
}

.btn-save:hover {
    background: #0056b3;
}

.btn-back {
    background: #6c757d;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    text-align: center;
    transition: background 0.3s;
}

.btn-back:hover {
    background: #495057;
}
</style>
@endsection
