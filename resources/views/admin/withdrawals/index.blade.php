@extends('layouts.app')

@section('title', 'Gestion des retraits')

@section('content')
<div class="admin-container">
    <h2>Gestion des Retraits</h2>

    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    <form method="GET" class="filter-form">
        <label for="status">Filtrer par statut :</label>
        <select name="status" id="status" onchange="this.form.submit()">
            <option value="">Tous</option>
            <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>En attente</option>
            <option value="validated" {{ request('status')=='validated' ? 'selected' : '' }}>Validés</option>
            <option value="completed" {{ request('status')=='completed' ? 'selected' : '' }}>Payés</option>
            <option value="rejected" {{ request('status')=='rejected' ? 'selected' : '' }}>Rejetés</option>
        </select>
    </form>

    <div class="table-container">
        <table class="withdrawals-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Solde actuel</th>
                    <th>Montant demandé</th>
                    <th>Méthode</th>
                    <th>Référence</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($withdrawals as $w)
                    <tr>
                        <td>{{ $w->id }}</td>
                        <td>{{ $w->user->name }} <br><small>{{ $w->user->email }}</small></td>
                        <td>{{ number_format($w->user->balance,0,',',' ') }} FCFA</td>
                        <td>{{ number_format($w->amount,0,',',' ') }} FCFA</td>
                        <td>{{ $w->method }}</td>
                        <td>{{ $w->reference }}</td>
                        <td>
                            <span class="status-badge {{ $w->status }}">
                                @if($w->status === 'pending') En attente
                                @elseif($w->status === 'validated') Validé
                                @elseif($w->status === 'completed') Payé
                                @elseif($w->status === 'rejected') Rejeté
                                @endif
                            </span>
                        </td>
                        <td>{{ $w->created_at->format('d/m/Y H:i') }}</td>
                        <td class="actions-column">
                            @if($w->status === 'pending')
                                <form method="POST" action="{{ route('admin.withdrawals.validate', $w->id) }}">
                                    @csrf
                                    <button type="submit" 
                                            class="btn btn-validate {{ $w->user->balance < $w->amount ? 'disabled' : '' }}"
                                            {{ $w->user->balance < $w->amount ? 'disabled' : '' }}>
                                        Valider
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.withdrawals.reject', $w->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-reject">Rejeter</button>
                                </form>
                            @elseif($w->status === 'validated')
                                <span class="text-muted">En attente de paiement</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="empty-table">Aucun retrait trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
.admin-container { max-width:1250px; margin:40px auto; padding:25px; font-family:'Poppins', sans-serif; }
.admin-container h2 { text-align:center; color:#0e1577; margin-bottom:30px; font-weight:600; }

.alert { padding:12px 15px; border-radius:8px; margin-bottom:25px; font-size:14px; }
.alert.success { background:#e6f9ed; color:#0a7f3e; border:1px solid #0a7f3e;}
.alert.error { background:#ffe6e6; color:#a00; border:1px solid #a00;}

.filter-form { margin-bottom:20px; text-align:right; }
.filter-form select { padding:8px 14px; border-radius:6px; border:1px solid #ccc; min-width:150px; }

.table-container { overflow-x:auto; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.05); }
.withdrawals-table { width:100%; border-collapse:collapse; min-width:950px; }
.withdrawals-table th, .withdrawals-table td { padding:14px 12px; border-bottom:1px solid #eee; text-align:left; }
.withdrawals-table th { background:#f5f5f5; font-weight:600; color:#333; }

.status-badge { padding:5px 12px; border-radius:12px; font-size:13px; font-weight:600; color:#fff; display:inline-block; }
.status-badge.pending { background:#d97706; }
.status-badge.validated { background:#16a34a; }
.status-badge.completed { background:#0e1577; }
.status-badge.rejected { background:#b91c1c; }

.actions-column form { margin-bottom:5px; }
.btn { display:block; width:100%; padding:8px 12px; border:none; border-radius:6px; font-size:14px; cursor:pointer; transition:all .3s; color:#fff; }
.btn-validate { background:linear-gradient(135deg,#0e1577,#2865c2); }
.btn-validate:hover { background:linear-gradient(135deg,#2865c2,#0e1577); transform:scale(1.05); }
.btn-reject { background:linear-gradient(135deg,#b91c1c,#dc2626); }
.btn-reject:hover { background:linear-gradient(135deg,#dc2626,#b91c1c); transform:scale(1.05); }
.btn.disabled { background:#ccc !important; cursor:not-allowed; transform:none; }

.text-muted { color:#999; font-style:italic; }
.empty-table { text-align:center; font-style:italic; color:#555; padding:20px 0; }

@media (max-width:1024px){
    .withdrawals-table th, .withdrawals-table td { padding:10px 8px; }
    .btn { font-size:13px; padding:6px 10px; }
}
</style>
@endsection
