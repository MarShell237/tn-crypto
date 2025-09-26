@extends('layouts.app')

@section('title','Déposer')

@section('content')
<div class="deposit-wrapper">
    <div class="deposit-card">
        <h2><i class="fas fa-wallet"></i> Faire un dépôt</h2>
        <p class="subtitle">Choisissez votre méthode et le montant à déposer.</p>

        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('depot.store') }}" id="deposit-form">
            @csrf

            <!-- Mode de paiement -->
            <div class="form-group">
                <label for="method"><i class="fas fa-credit-card"></i> Mode de paiement</label>
                <select name="method" id="method" class="form-control" required onchange="onMethodChange()">
                    <option value="">Sélectionnez un moyen</option>
                    @foreach($methods as $m)
                        <option value="{{ $m }}" @if(old('method')===$m) selected @endif>{{ $m }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Numéro pour OM/MOMO -->
            <div class="form-group" id="phone-group">
                <label for="phone"><i class="fas fa-mobile-alt"></i> Numéro (MOMO / OM)</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="+2376..." class="form-control">
                <small>Entrez le numéro mobile lié au paiement.</small>
            </div>

            <!-- Montant -->
            <div class="form-group">
                <label><i class="fas fa-coins"></i> Montant (FCFA)</label>
                <div class="amount-options">
                    @foreach([5000,10000,30000,50000,75000,150000,220000,450000,700000,900000,1000000] as $montant)
                        <label class="amount-box">
                            <input type="radio" name="amount" value="{{ $montant }}" 
                                   @if(old('amount')==$montant) checked @endif required>
                            <span>{{ number_format($montant, 0, ',', ' ') }} FCFA</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-arrow-right"></i> Continuer
            </button>
        </form>
    </div>
</div>

<style>
body {
    background: linear-gradient(135deg, #0e1577, #2865c2);
    font-family: 'Poppins', sans-serif;
}

/* Wrapper centré */
.deposit-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 50px 15px;
}

/* Carte principale */
.deposit-card {
    width: 100%;
    max-width: 550px;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 35px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    animation: fadeIn 0.6s ease-in-out;
}

.deposit-card h2 {
    text-align: center;
    color: #0e1577;
    margin-bottom: 8px;
    font-weight: 700;
}

.subtitle {
    text-align: center;
    font-size: 14px;
    color: #666;
    margin-bottom: 25px;
}

/* Champs formulaire */
.form-group {
    margin-bottom: 20px;
}

.form-control {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid #ddd;
    font-size: 14px;
    transition: 0.3s;
    background: #f9f9f9;
}

.form-control:focus {
    border-color: #2865c2;
    background: #fff;
    box-shadow: 0 0 6px rgba(40,101,194,0.4);
    outline: none;
}

label {
    font-weight: 500;
    color: #333;
    margin-bottom: 6px;
    display: block;
}

/* Montants en carte */
.amount-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 12px;
}

.amount-box {
    position: relative;
    border: 2px solid #ddd;
    border-radius: 10px;
    text-align: center;
    padding: 15px;
    cursor: pointer;
    transition: all 0.3s;
    font-weight: 600;
    color: #0e1577;
    background: #fff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.05);
}

.amount-box input {
    display: none;
}

.amount-box:hover {
    border-color: #2865c2;
    transform: translateY(-3px);
}

.amount-box input:checked + span {
    display: inline-block;
    background: linear-gradient(135deg, #0e1577, #2865c2);
    color: white;
    border-radius: 8px;
    padding: 10px 15px;
    box-shadow: 0 4px 15px rgba(14,21,119,0.3);
}

/* Bouton */
.btn-submit {
    width: 100%;
    padding: 14px 0;
    background: linear-gradient(135deg, #2865c2, #0e1577);
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s;
    margin-top: 15px;
}

.btn-submit:hover {
    transform: scale(1.03);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}

/* Erreurs */
.error-messages {
    background: #ffe6e6;
    border: 1px solid #ffb3b3;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.error-messages li {
    color: #a00;
    font-size: 14px;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media(max-width: 576px){
    .deposit-card {
        padding: 25px;
    }
}
</style>

<script>
function onMethodChange(){
    const method = document.getElementById('method').value;
    const phoneGroup = document.getElementById('phone-group');
    phoneGroup.style.display = (method === 'MOMO' || method === 'OM') ? 'block' : 'none';
}
</script>
@endsection
