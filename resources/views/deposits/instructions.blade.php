@extends('layouts.app')

@section('title','Instructions de paiement')

@section('content')
<div class="payment-wrapper">
    <div class="payment-card">
        <h2><i class="fas fa-receipt"></i> Instructions de paiement</h2>
        <p class="method-label">{{ $deposit->method }}</p>

        <div class="deposit-info">
            <p>Référence: <strong>{{ $deposit->reference }}</strong></p>
            <p>Montant: <strong>{{ number_format($deposit->amount, 0, ',', ' ') }} FCFA</strong></p>
        </div>

        <div class="instructions">
            <h4><i class="fas fa-info-circle"></i> Mode: {{ $deposit->method }}</h4>
            <p>Envoyez le montant exact au numéro suivant depuis votre compte mobile (ou suivez la procédure de votre opérateur) :</p>

            <ul>
                <li>Numéro à payer : <strong>+237 698 754 354</strong> (Arold Diva)</li>
                <li>Message / Motif : <strong>{{ $deposit->reference }}</strong></li>
            </ul>

            <p class="note">Après le dépôt, envoyez une capture au support pour confirmation.</p>
        </div>

        <div class="action">
            <a href="{{ route('depot.create') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Faire un autre dépôt
            </a>
        </div>
    </div>
</div>

<style>
body {
    background: #f0f4ff;
    font-family: 'Poppins', sans-serif;
}

/* Wrapper */
.payment-wrapper {
    display: flex;
    justify-content: center;
    padding: 40px 15px;
}

/* Carte */
.payment-card {
    background: #fff;
    max-width: 700px;
    width: 100%;
    padding: 35px 30px;
    border-radius: 16px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.07);
    text-align: center;
    animation: fadeIn 0.5s ease-in-out;
}

/* Titres */
.payment-card h2 {
    font-size: 1.9rem;
    color: #0e1577;
    margin-bottom: 6px;
}

.payment-card .method-label {
    font-size: 14px;
    color: #555;
    margin-bottom: 20px;
    font-weight: 500;
}

/* Infos dépôt */
.deposit-info p {
    font-size: 16px;
    margin: 8px 0;
    color: #333;
    font-weight: 500;
}

/* Instructions */
.instructions {
    background: #f9f9f9ff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    margin: 20px 0;
    text-align: left;
}

.instructions h4 {
    color: #2865c2;
    margin-bottom: 12px;
}

.instructions p {
    color: #555;
    font-size: 14px;
    margin-bottom: 12px;
}

.instructions ul {
    padding-left: 20px;
    margin-bottom: 10px;
}

.instructions ul li {
    margin-bottom: 6px;
    font-size: 14px;
}

.instructions .note {
    font-size: 13px;
    color: #0e1577;
    font-weight: 600;
}

/* Bouton retour */
.action {
    margin-top: 20px;
}

.btn-back {
    display: inline-block;
    text-decoration: none;
    background: linear-gradient(135deg, #0e1577, #2865c2);
    color: #fff;
    font-weight: 600;
    padding: 12px 22px;
    border-radius: 10px;
    transition: all 0.3s;
}

.btn-back:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media(max-width: 576px){
    .payment-card {
        padding: 25px 20px;
    }
}
</style>
@endsection
