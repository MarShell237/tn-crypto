@extends('layouts.app')

@section('title','Paiement Autres')

@section('content')
<div class="deposit-wrapper">
    <div class="deposit-card">
        <h2><i class="fas fa-exchange-alt"></i> Paiement via Autres</h2>
        <p class="subtitle">
            Pour finaliser votre dépôt, cliquez sur le bouton ci-dessous.<br>
            Vous serez redirigé vers la page de paiement sécurisée.
        </p>

        <div class="instructions-box">
            <p><i class="fas fa-link"></i> Lien de paiement: https://vnvshfpe.mychariow.store/prd_11vdjr/checkout</p>
            <a href="{{ $paymentLink }}" target="_blank" class="btn-submit">
                <i class="fas fa-lock"></i> Payer maintenant
            </a>
        </div>

        <p class="note">
            ⚠️ Après le paiement, votre dépôt sera validé automatiquement sous 10 à 15 minutes.
        </p>
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
    max-width: 520px;
    background: rgba(255,255,255,0.95);
    border-radius: 16px;
    padding: 35px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    text-align: center;
    animation: fadeIn 0.6s ease-in-out;
}

.deposit-card h2 {
    color: #0e1577;
    margin-bottom: 10px;
    font-weight: 700;
}

.subtitle {
    font-size: 15px;
    color: #444;
    margin-bottom: 25px;
    line-height: 1.5;
}

.instructions-box {
    background: #f9f9f9;
    padding: 18px;
    border-radius: 12px;
    border: 1px solid #ddd;
    margin-bottom: 20px;
}

.instructions-box p {
    margin-bottom: 12px;
    font-weight: 600;
    color: #333;
}

/* Bouton */
.btn-submit {
    display: inline-block;
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
    text-decoration: none;
}

.btn-submit:hover {
    transform: scale(1.03);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}

.note {
    font-size: 13px;
    color: #a00;
    margin-top: 15px;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endsection
