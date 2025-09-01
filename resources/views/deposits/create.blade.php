@extends('layouts.app')

@section('content')
<div class="deposit-form">
    <h1>Dépôt</h1>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('deposit.store') }}" method="POST">
        @csrf
        <label>Pays :</label>
        <select name="country" required>
            @foreach($countries as $country => $currency)
                <option value="{{ $country }}">{{ $country }} ({{ $currency }})</option>
            @endforeach
        </select>

        <label>Montant :</label>
        <input type="number" name="amount" placeholder="1000" min="1000" required>

        <button type="submit">Effectuer le dépôt</button>
    </form>
</div>

<style>
.deposit-form {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background: #1a1a1a;
    color: #fff;
    border-radius: 12px;
}
.deposit-form h1 {
    text-align: center;
    margin-bottom: 20px;
}
.deposit-form input, .deposit-form select, .deposit-form button {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: none;
    font-size: 16px;
}
.deposit-form button {
    background-color: #3a8dff;
    cursor: pointer;
    color: #fff;
}
</style>
@endsection
