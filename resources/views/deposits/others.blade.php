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
            <p><i class="fas fa-link"></i> Lien de paiement :</p>
            <div class="payment-link">https://ictcvroc.mychariow.shop/prd_h89ur4/checkout</div>
            <a href="https://ictcvroc.mychariow.shop/prd_h89ur4/checkout" target="_blank" class="btn-submit">
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
    margin: 0;
    padding: 0;
}

/* Wrapper centré */
.deposit-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 50px 15px;
    min-height: 100vh;
}

/* Carte principale */
.deposit-card {
    width: 100%;
    max-width: 520px;
    background: rgba(255,255,255,0.97);
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
    font-size: 24px;
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
    word-wrap: break-word;
    overflow-wrap: anywhere;
}

.instructions-box p {
    margin-bottom: 10px;
    font-weight: 600;
    color: #333;
}

.payment-link {
    font-size: 14px;
    color: #0e1577;
    margin-bottom: 15px;
    word-break: break-all;
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

/* 🌐 Responsive */
@media (max-width: 768px) {
    .deposit-card {
        padding: 25px;
        max-width: 95%;
    }
    .deposit-card h2 {
        font-size: 20px;
    }
    .subtitle {
        font-size: 14px;
    }
    .btn-submit {
        font-size: 15px;
        padding: 12px 0;
    }
}

@media (max-width: 480px) {
    .deposit-wrapper {
        padding: 30px 10px;
    }
    .deposit-card {
        padding: 20px;
        border-radius: 12px;
    }
    .deposit-card h2 {
        font-size: 18px;
    }
    .subtitle {
        font-size: 13px;
    }
    .instructions-box {
        padding: 14px;
    }
    .payment-link {
        font-size: 12.5px;
    }
    .btn-submit {
        font-size: 14px;
        padding: 10px 0;
    }
    .note {
        font-size: 12px;
    }
}
</style>
@endsection
