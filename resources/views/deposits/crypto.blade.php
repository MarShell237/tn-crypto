@extends('layouts.app')

@section('title','Payer en Crypto')

@section('content')
<div style="max-width:760px;margin:40px auto;text-align:center;">
    <h2>Paiement Crypto</h2>

    <p>Référence: <strong>{{ $deposit->reference }}</strong></p>
    <p>Montant (FCFA): <strong>{{ number_format($deposit->amount, 0, ',', ' ') }} FCFA</strong></p>

    <div style="background:#fff;padding:18px;border-radius:10px;box-shadow:0 6px 18px rgba(0,0,0,0.06);">
        <h4>Adresse de dépôt</h4>
        <p><code id="wallet">{{ $walletAddress }}</code></p>

        <p>Scannez le QR ou copiez l'adresse ci-dessus et envoyez le montant équivalent en crypto.</p>

        <button onclick="copyWallet()" style="padding:8px 12px;border-radius:8px;border:none;background:#0e1577;color:#fff;">Copier l'adresse</button>

        <p style="margin-top:12px;font-size:13px;color:#666;">Une fois le paiement effectué, envoyez-nous la preuve (tx id) pour vérification.</p>
    </div>

    <div style="margin-top:14px;">
        <a href="{{ route('depot.create') }}" style="text-decoration:none;color:#0e1577;">← Faire un autre dépôt</a>
    </div>
</div>

<script>
function copyWallet(){
    const wallet = document.getElementById('wallet').innerText;
    navigator.clipboard.writeText(wallet).then(()=> alert('Adresse copiée'));
}
</script>
@endsection
