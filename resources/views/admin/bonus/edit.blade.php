@extends('layouts.app')

@section('content')
<div style="display:flex; justify-content:center; align-items:center; min-height:80vh;">
    <div style="
        width: 100%; 
        max-width: 500px; 
        padding: 25px; 
        background-color: #f9f9f9; 
        border-radius: 12px; 
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    ">
        <h2 style="text-align:center; margin-bottom:30px; color:#333; font-family:Arial, sans-serif;">
            <i class="fas fa-gift"></i> Configurer le Bonus : <span style="color:#2c3e50;">{{ $bonus->code }}</span>
        </h2>

        @if($errors->any())
            <div style="
                background-color: #fdecea; 
                color: #e74c3c; 
                padding: 10px; 
                border-radius: 6px; 
                margin-bottom: 20px;
                font-size: 14px;
            ">
                <i class="fas fa-exclamation-triangle"></i> {{ implode(', ', $errors->all()) }}
            </div>
        @endif

        @if(session('success'))
            <div style="
                background-color: #eafaf1; 
                color: #27ae60; 
                padding: 10px; 
                border-radius: 6px; 
                margin-bottom: 20px;
                font-size: 14px;
            ">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('bonus.update', $bonus->id) }}" method="POST">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:5px; font-weight:bold; color:#333;">
                    <i class="fas fa-coins"></i> Montant
                </label>
                <input 
                    type="number" 
                    name="amount" 
                    value="{{ old('amount', $bonus->amount) }}" 
                    step="0.01" 
                    required
                    style="
                        width:100%; 
                        padding:12px; 
                        border:1px solid #ccc; 
                        border-radius:6px; 
                        outline:none;
                        transition: border 0.3s;
                    "
                    onfocus="this.style.border='1px solid #27ae60';" 
                    onblur="this.style.border='1px solid #ccc';"
                >
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:5px; font-weight:bold; color:#333;">
                    <i class="fas fa-clock"></i> Date d’expiration
                </label>
                <input 
                    type="datetime-local" 
                    name="expires_at" 
                    value="{{ old('expires_at', $bonus->expires_at ? $bonus->expires_at->format('Y-m-d\TH:i') : '') }}" 
                    required
                    style="
                        width:100%; 
                        padding:12px; 
                        border:1px solid #ccc; 
                        border-radius:6px; 
                        outline:none; 
                        font-size:14px;
                        box-sizing:border-box;
                        transition: border 0.3s, box-shadow 0.3s;
                    "
                    onfocus="this.style.border='1px solid #27ae60'; this.style.boxShadow='0 0 5px rgba(39, 174, 96, 0.5)';" 
                    onblur="this.style.border='1px solid #ccc'; this.style.boxShadow='none';"
                />

            </div>

            <button type="submit" style="
                width:100%;
                padding:12px; 
                border:none; 
                border-radius:6px; 
                background-color:#27ae60; 
                color:#fff; 
                font-weight:bold; 
                cursor:pointer; 
                transition: background 0.3s;
            " 
            onmouseover="this.style.backgroundColor='#1e8449';" 
            onmouseout="this.style.backgroundColor='#27ae60';"
            >
                <i class="fas fa-save"></i> Enregistrer
            </button>
        </form>
    </div>
</div>
@endsection
