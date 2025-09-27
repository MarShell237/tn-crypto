@extends('layouts.app')

@section('content')
<style>
    .bonus-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 90vh;
        background: #f5f7fa;
    }
    .bonus-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        padding: 40px;
        width: 100%;
        max-width: 500px;
        text-align: center;
    }
    .bonus-card h2 {
        font-size: 24px;
        color: #2c3e50;
        margin-bottom: 20px;
    }
    .alert {
        border-radius: 10px;
        padding: 12px;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
    }
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
    }
    .form-label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
        text-align: left;
    }
    .input-group {
        display: flex;
        align-items: center;
        border: 2px solid #ccc;
        border-radius: 10px;
        overflow: hidden;
    }
    .input-group span {
        background: #eee;
        padding: 10px 15px;
        font-size: 20px;
        color: #28a745;
    }
    .input-group input {
        border: none;
        outline: none;
        flex: 1;
        padding: 12px;
        font-size: 16px;
        text-align: center;
        font-weight: bold;
    }
    .btn-submit {
        margin-top: 20px;
        width: 100%;
        background: #28a745;
        color: white;
        padding: 14px;
        font-size: 18px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-submit:hover {
        background: #218838;
    }
    .note {
        margin-top: 20px;
        font-size: 14px;
        color: #666;
    }
</style>

<div class="bonus-wrapper">
    <div class="bonus-card">
        <h2><i class="fas fa-gift"></i> Utiliser un code bonus</h2>

        {{-- Message de succès --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Erreurs --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> {{ implode(', ', $errors->all()) }}
            </div>
        @endif

        {{-- Formulaire --}}
        <form action="{{ route('bonus.apply') }}" method="POST">
            @csrf
            <label for="bonus-code" class="form-label">
                <i class="fas fa-key"></i> Entrez votre code :
            </label>
            <div class="input-group">
                <span><i class="fas fa-ticket-alt"></i></span>
                <input type="text" id="bonus-code" name="code" placeholder="ABCD1234" required>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane"></i> Valider
            </button>
        </form>

        <p class="note">
            <i class="far fa-clock"></i> Vérifiez bien la validité du code avant utilisation.
        </p>
    </div>
</div>
@endsection
