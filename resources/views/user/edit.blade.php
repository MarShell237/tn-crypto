@extends('layouts.app')

@section('content')
<style>
/* Container principal */
.edit-container {
    max-width: 500px;
    margin: 50px auto;
    background: linear-gradient(145deg, #1f1f2e, #252536);
    padding: 30px 35px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    color: #e0e0e0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.edit-container:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.6);
}

/* Titre */
.edit-container h2 {
    text-align: center;
    color: #3a8dff;
    font-size: 28px;
    margin-bottom: 25px;
    font-weight: 700;
    letter-spacing: 1px;
}

/* Messages succès */
.edit-container .success-message {
    background-color: #4caf50;
    color: #fff;
    padding: 12px 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: 500;
    box-shadow: 0 3px 10px rgba(0,0,0,0.3);
}

/* Inputs & select */
.edit-container input,
.edit-container select {
    width: 100%;
    padding: 14px;
    margin-bottom: 18px;
    border-radius: 8px;
    border: 1px solid #3a3a4e;
    background-color: #2b2b3d;
    color: #e0e0e0;
    font-size: 16px;
    transition: all 0.3s ease;
}
.edit-container input:focus,
.edit-container select:focus {
    border-color: #3a8dff;
    background-color: #323248;
    outline: none;
    box-shadow: 0 0 8px rgba(58, 141, 255, 0.5);
}

/* Bouton */
.edit-container button {
    width: 100%;
    padding: 14px;
    background-color: #3a8dff;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.edit-container button:hover {
    background-color: #2865c2;
    transform: scale(1.03);
    box-shadow: 0 6px 15px rgba(0,0,0,0.3);
}

/* Optionnel : message d'erreur */
.edit-container .error-message {
    background-color: #ff4d4f;
    color: #fff;
    padding: 10px 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    text-align: center;
    font-weight: 500;
    box-shadow: 0 3px 10px rgba(0,0,0,0.3);
}

/* Responsive */
@media (max-width: 768px) {
    .edit-container {
        padding: 25px 20px;
        margin: 30px 15px;
    }
    .edit-container input{
        width: 90%;
    }
    .edit-container select{
        width: 103%;
    }
    select .pays{
        width: 50px;
    }
}
</style>

<div class="edit-container">
    <h2>Modifier mes informations</h2>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="error-message">
            <ul style="list-style: none; margin:0; padding:0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.update') }}" method="POST">
        @csrf
        <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Nom complet" required>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" required>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Téléphone">
        <select name="country">
            @foreach(\App\Helpers\Countries::list() as $country)
                <option class="pays" value="{{ $country }}" {{ $user->country == $country ? 'selected' : '' }}>
                    {{ $country }}
                </option>
            @endforeach
        </select>
        <button type="submit">Mettre à jour</button>
    </form>
</div>
@endsection
