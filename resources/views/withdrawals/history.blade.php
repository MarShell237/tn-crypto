@extends('layouts.app')

@section('title', 'Historique des retraits')

@section('content')
<div class="history-wrapper">
    <h2>📜 Historique de mes retraits</h2>

    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    <div class="history-cards">
        @forelse($withdrawals as $withdrawal)
            <div class="card">
                <div class="card-header">
                    <span class="amount">{{ number_format($withdrawal->amount, 0, ',', ' ') }} FCFA</span>
                    <span class="status {{ $withdrawal->status }}">
                        @if($withdrawal->status === 'pending') ⏳ En attente
                        @elseif($withdrawal->status === 'validated') ✅ Validé
                        @elseif($withdrawal->status === 'completed') 💸 Payé
                        @endif
                    </span>
                </div>
                <div class="card-body">
                    <p><strong>Méthode :</strong> {{ $withdrawal->method }}</p>
                    <p><strong>Référence :</strong> {{ $withdrawal->reference }}</p>
                    <p><strong>Date :</strong> {{ $withdrawal->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        @empty
            <p class="empty">Aucun retrait trouvé.</p>
        @endforelse
    </div>
</div>

<style>
.history-wrapper {
    max-width: 1000px;
    margin: 40px auto;
    padding: 20px;
    font-family: 'Poppins', sans-serif;
}
.history-wrapper h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #0e1577;
}

.alert {
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 20px;
}
.alert.success { background:#e6f9ed; color:#0a7f3e; }
.alert.error { background:#ffe6e6; color:#a00; }

.history-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
}

.card {
    border: 1px solid #eee;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0,0,0,0.06);
    background: #fff;
    transition: transform 0.2s ease-in-out;
}
.card:hover { transform: translateY(-4px); }

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 18px;
    background: linear-gradient(135deg,#0e1577,#2865c2);
    color: #fff;
}
.card-header .amount {
    font-size: 18px;
    font-weight: 700;
}
.card-header .status {
    font-size: 14px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 6px;
}
.status.pending { background:#fcd34d; color:#78350f; }
.status.validated { background:#86efac; color:#064e3b; }
.status.completed { background:#93c5fd; color:#1e3a8a; }

.card-body {
    padding: 15px 18px;
    color: #333;
}
.card-body p { margin: 6px 0; }

.empty {
    text-align: center;
    margin-top: 30px;
    font-style: italic;
    color: #888;
}
</style>
@endsection
