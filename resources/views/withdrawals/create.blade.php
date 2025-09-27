@extends('layouts.app')

@section('title', 'Demander un retrait')

@section('content')
<div class="withdraw-page">
    <div class="withdraw-card">
        <h2>💸 Faire un Retrait</h2>

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('withdrawals.store') }}" method="POST" class="withdraw-form">
            @csrf
            <div class="form-group">
                <label for="amount">Montant (FCFA)</label>
                <input type="number" name="amount" id="amount" value="{{ old('amount') }}" required min="2000" placeholder="Ex: 5000">
                @error('amount') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="method">Méthode</label>
                <select name="method" id="method" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="MOMO" {{ old('method')=='MOMO' ? 'selected':'' }}>MTN Mobile Money</option>
                    <option value="OM" {{ old('method')=='OM' ? 'selected':'' }}>Orange Money</option>
                    <option value="CRYPTO" {{ old('method')=='CRYPTO' ? 'selected':'' }}>Crypto</option>
                </select>
                @error('method') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="phone">Téléphone / Adresse crypto</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required placeholder="Ex: 672XXXXXX ou 0xabc123...">
                @error('phone') <small class="error">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn-submit">Demander</button>
        </form>
    </div>
</div>

<style>
/* Layout principal */
.withdraw-page {
    display: flex;
    justify-content: center;
    padding: 40px 20px;
    background: #f8fafc;
}

/* Carte centrale */
.withdraw-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    padding: 30px 25px;
    max-width: 500px;
    width: 100%;
    animation: fadeIn 0.5s ease-in-out;
}

.withdraw-card h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 22px;
    font-weight: 700;
    color: #0e1577;
}

/* Formulaire */
.withdraw-form .form-group {
    margin-bottom: 20px;
}

.withdraw-form label {
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
    color: #333;
}

/* Harmonisation largeur */
.withdraw-form input, 
.withdraw-form select,
.btn-submit {
    display: block;
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    font-size: 15px;
    transition: all 0.2s ease;
    background: #f9fafb;
    box-sizing: border-box;
}

.withdraw-form input:focus, 
.withdraw-form select:focus {
    border-color: #2865c2;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(40,101,194,0.15);
    outline: none;
}

.error {
    color: #dc2626;
    font-size: 13px;
    margin-top: 4px;
    display: block;
}

/* Bouton */
.btn-submit {
    font-size: 16px;
    font-weight: 600;
    border: none;
    background: linear-gradient(135deg,#0e1577,#2865c2);
    color: #fff;
    cursor: pointer;
    transition: transform 0.2s, background 0.3s;
}
.btn-submit:hover {
    transform: translateY(-2px);
    background: linear-gradient(135deg,#2865c2,#0e1577);
}

/* Alertes */
.alert {
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 500;
}
.alert.success {
    background:#ecfdf5; color:#065f46; border:1px solid #34d399;
}
.alert.error {
    background:#fef2f2; color:#991b1b; border:1px solid #f87171;
}

/* Animation */
@keyframes fadeIn {
    from { opacity:0; transform: translateY(10px); }
    to { opacity:1; transform: translateY(0); }
}
</style>
@endsection
