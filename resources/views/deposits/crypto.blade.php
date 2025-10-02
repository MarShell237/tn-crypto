@extends('layouts.app')

@section('title','Payer en Crypto')

@section('content')
<div class="crypto-wrapper">
    <h2>Paiement Crypto</h2>

    <p class="deposit-info">Référence: <strong>{{ $deposit->reference }}</strong></p>
    <p class="deposit-info">Montant (FCFA): <strong>{{ number_format($deposit->amount, 0, ',', ' ') }} FCFA</strong></p>

    <div class="crypto-card">
        <h4>Adresse de dépôt</h4>
        <p><code id="wallet">TRGcqjYxSdW8MST7paKhUUgb7iJAijozhj</code></p>

        <p>N'effectuez que les depots via le reseau  <strong>TRC20</strong> sur cette adresse.</p>
        <p>Scannez le QR ou copiez l'adresse ci-dessus et envoyez le montant équivalent en crypto.</p>
        

        <button onclick="copyWallet()" class="btn-copy">Copier l'adresse</button>

        <p class="note">Une fois le paiement effectué, envoyez-nous la preuve (tx id) pour vérification.</p>
    </div>

    <div class="back-link">
        <a href="{{ route('depot.create') }}">← Faire un autre dépôt</a>
    </div>
</div>

<style>
.crypto-wrapper {
    max-width: 760px;
    margin: 40px auto;
    text-align: center;
    font-family: 'Poppins', sans-serif;
}

.crypto-wrapper h2 {
    font-size: 28px;
    color: #0e1577;
    margin-bottom: 18px;
}

.deposit-info {
    font-size: 16px;
    margin: 6px 0;
    color: #333;
}

.crypto-card {
    background: #fff;
    padding: 25px 20px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    margin-top: 20px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.crypto-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

.crypto-card h4 {
    margin-bottom: 12px;
    color: #0e1577;
}

.crypto-card code {
    display: inline-block;
    background: #f4f4f4;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 14px;
    word-break: break-all;
    color: #0e1577;
    margin-bottom: 12px;
}

.crypto-card p {
    font-size: 14px;
    color: #555;
    margin-bottom: 12px;
}

.btn-copy {
    padding: 10px 18px;
    border-radius: 8px;
    border: none;
    background: linear-gradient(135deg, #0e1577, #2865c2);
    color: #fff;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-copy:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(14,21,119,0.2);
}

.note {
    margin-top: 12px;
    font-size: 13px;
    color: #666;
}

.back-link {
    margin-top: 18px;
}

.back-link a {
    text-decoration: none;
    color: #0e1577;
    font-weight: 500;
}

.back-link a:hover {
    text-decoration: underline;
}

p {
    line-height: 1.6;
}
</style>

<script>
function copyWallet(){
    const wallet = document.getElementById('wallet').innerText;
    navigator.clipboard.writeText(wallet)
        .then(() => alert('Adresse copiée !'))
        .catch(() => alert('Impossible de copier l’adresse.'));
}
</script>
@endsection




