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
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Contact</th>
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
                        <td>{{ $w->user->name }}</td>
                        <td>{{ $w->user->email }}</td>
                        <td><i class="fas fa-phone"></i> {{ $w->phone ?? 'N/A' }}</td>
                        <td>{{ number_format($w->user->balance,0,',',' ') }} FCFA</td>
                        <td><strong>{{ number_format($w->amount,0,',',' ') }} FCFA</strong></td>
                        <td>{{ ucfirst($w->method) }}</td>
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
                    <tr><td colspan="11" class="empty-table">Aucun retrait trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Styles conservés --}}
<style>
/* --- Container --- */
.admin-container { max-width: 1250px; margin: 40px auto; padding: 25px; font-family: 'Poppins', sans-serif; }
.admin-container h2 { text-align: center; color: #0e1577; margin-bottom: 30px; font-weight: 600; font-size: 24px; }

/* --- Alerts --- */
.alert { padding: 12px 15px; border-radius: 8px; margin-bottom: 25px; font-size: 14px; font-weight: 500; }
.alert.success { background:#e6f9ed; color:#0a7f3e; border:1px solid #0a7f3e; }
.alert.error { background:#ffe6e6; color:#a00; border:1px solid #a00; }

/* --- Filtres --- */
.filter-form { margin-bottom: 20px; text-align: right; }
.filter-form label { margin-right: 10px; font-weight: 500; }
.filter-form select { padding: 8px 14px; border-radius: 6px; border: 1px solid #ccc; min-width: 160px; }

/* --- Table --- */
.table-container { overflow-x: auto; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); background: #fff; }
.withdrawals-table { width: 100%; border-collapse: collapse; min-width: 1150px; }
.withdrawals-table th, .withdrawals-table td { padding: 14px 12px; border-bottom: 1px solid #f0f0f0; text-align: left; vertical-align: middle; }
.withdrawals-table th { background: #f8f9fc; font-weight: 600; color: #333; font-size: 14px; }
.withdrawals-table tbody tr:nth-child(even) { background: #fafafa; }
.withdrawals-table td { font-size: 13px; color: #444; }

/* --- Badges --- */
.status-badge { padding: 6px 12px; border-radius: 20px; font-size: 13px; font-weight: 600; color: #fff; display: inline-block; }
.status-badge.pending { background: #f59e0b; }
.status-badge.validated { background: #16a34a; }
.status-badge.completed { background: #0e1577; }
.status-badge.rejected { background: #dc2626; }

/* --- Actions --- */
.actions-column form { margin-bottom: 6px; }
.btn { display: block; width: 100%; padding: 8px 12px; border: none; border-radius: 8px; font-size: 13px; cursor: pointer; transition: all .3s; color: #fff; font-weight: 500; }
.btn-validate { background: linear-gradient(135deg,#0e1577,#2865c2); }
.btn-validate:hover { background: linear-gradient(135deg,#2865c2,#0e1577); transform: scale(1.04); }
.btn-reject { background: linear-gradient(135deg,#b91c1c,#dc2626); }
.btn-reject:hover { background: linear-gradient(135deg,#dc2626,#b91c1c); transform: scale(1.04); }
.btn.disabled { background: #ccc !important; cursor: not-allowed; transform: none; }

/* --- Texte --- */
.text-muted { color: #999; font-style: italic; }
.empty-table { text-align: center; font-style: italic; color: #555; padding: 20px 0; }

/* --- Responsive --- */
@media (max-width:1024px){ .withdrawals-table th, .withdrawals-table td { padding: 10px 8px; font-size: 13px; } .btn { font-size: 12px; padding: 6px 10px; } }
@media (max-width:768px){ .filter-form { text-align: center; } .filter-form label { display:block; margin-bottom:8px; } .filter-form select { width: 100%; } .withdrawals-table { min-width: 900px; } .withdrawals-table th, .withdrawals-table td { font-size: 12px; padding: 8px 6px; } .status-badge { font-size: 11px; padding: 4px 8px; } }
@media (max-width:480px){ .admin-container { padding: 15px; } .admin-container h2 { font-size: 20px; } .withdrawals-table { min-width: 800px; } .withdrawals-table th, .withdrawals-table td { font-size: 11px; padding: 6px 4px; } .status-badge { font-size: 10px; padding: 3px 6px; } }
</style>
@endsection
