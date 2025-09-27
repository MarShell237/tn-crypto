@extends('layouts.app')

@section('title', 'Mes retraits')

@section('content')
<div class="history-container">
    <h2>Historique de mes retraits</h2>

    <div class="table-container">
        <table class="history-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Montant (FCFA)</th>
                    <th>Méthode</th>
                    <th>Référence</th>
                    <th>Statut</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($withdrawals as $w)
                    <tr>
                        <td>{{ $w->id }}</td>
                        <td>{{ number_format($w->amount,0,',',' ') }}</td>
                        <td>{{ $w->method }}</td>
                        <td>{{ $w->reference }}</td>
                        <td>
                            @if($w->status === 'pending')
                                <span class="status pending">En attente</span>
                            @elseif($w->status === 'validated')
                                <span class="status validated">Validé</span>
                            @elseif($w->status === 'completed')
                                <span class="status completed">Payé</span>
                            @endif
                        </td>
                        <td>{{ $w->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;">Aucun retrait trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
.history-container { max-width:1000px; margin:40px auto; padding:20px; font-family:'Poppins', sans-serif; }
.history-container h2 { text-align:center; color:#0e1577; margin-bottom:25px; }

.table-container { overflow-x:auto; }
.history-table { width:100%; border-collapse:collapse; }
.history-table th, .history-table td { padding:12px 10px; border-bottom:1px solid #eee; }
.history-table th { background:#f5f5f5; font-weight:600; }

.status.pending { color:#d97706; font-weight:bold; }
.status.validated { color:#16a34a; font-weight:bold; }
.status.completed { color:#0e1577; font-weight:bold; }
</style>
@endsection
