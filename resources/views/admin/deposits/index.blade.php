@extends('layouts.app')

@section('title', 'Gestion des dépôts')

@section('content')
<div class="admin-container">
    <h2>💳 Gestion des Dépôts</h2>

    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    <!-- Filtre par statut -->
    <form method="GET" class="filter-form">
        <label for="status">Filtrer par statut :</label>
        <select name="status" id="status" onchange="this.form.submit()">
            <option value="">Tous</option>
            <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>En attente</option>
            <option value="validated" {{ request('status')=='validated' ? 'selected' : '' }}>Validés</option>
        </select>
    </form>

    <div class="table-container">
        <table class="deposits-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Téléphone</th>
                    <th>Montant (FCFA)</th>
                    <th>Méthode</th>
                    <th>Référence</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($deposits as $deposit)
                    <tr>
                        <td>{{ $deposit->id }}</td>
                        <td>
                            <strong>{{ $deposit->user->name }}</strong>
                            <br><small>{{ $deposit->user->email }}</small>
                        </td>
                        <td>{{ $deposit->user->phone ?? '—' }}</td>
                        <td><strong>{{ number_format($deposit->amount,0,',',' ') }}</strong></td>
                        <td>{{ $deposit->method }}</td>
                        <td>{{ $deposit->reference }}</td>
                        <td>
                            @if($deposit->status === 'pending')
                                <span class="status pending">En attente</span>
                            @elseif($deposit->status === 'validated')
                                <span class="status validated">Validé</span>
                            @elseif($deposit->status === 'completed')
                                <span class="status completed">Terminé</span>
                            @endif
                        </td>
                        <td>{{ $deposit->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($deposit->status === 'pending')
                                <form method="POST" action="{{ route('admin.deposit.validate', $deposit->id) }}">
                                    @csrf
                                    <button type="submit" class="btn-validate">Valider</button>
                                </form>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="no-data">Aucun dépôt trouvé.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

<style>
/* --- Container --- */
.admin-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 25px;
    font-family: 'Poppins', sans-serif;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}
.admin-container h2 {
    text-align: center;
    color: #0e1577;
    margin-bottom: 30px;
    font-size: 26px;
    font-weight: 600;
}

/* --- Alertes --- */
.alert {
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 25px;
    font-weight: 500;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}
.alert.success { background: #e6f9ed; color: #0a7f3e; }
.alert.error { background: #ffe6e6; color: #a00; }

/* --- Filtre --- */
.filter-form { margin-bottom: 20px; text-align: right; }
.filter-form label { margin-right: 10px; font-weight: 500; }
.filter-form select {
    padding: 7px 14px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
    transition: 0.3s;
}
.filter-form select:hover { border-color: #0e1577; }

/* --- Table --- */
.table-container { overflow-x: auto; }
.deposits-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 850px;
}
.deposits-table th, .deposits-table td {
    padding: 14px 12px;
    border-bottom: 1px solid #eee;
    text-align: left;
    vertical-align: middle;
}
.deposits-table th {
    background: #f8f9fc;
    color: #0e1577;
    font-weight: 600;
    font-size: 14px;
}
.deposits-table tbody tr:nth-child(even) {
    background: #fafafa;
}
.deposits-table td small { color: #666; font-size: 12px; }

/* --- Statuts --- */
.status {
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 13px;
    display: inline-block;
}
.status.pending { background: #fff4e5; color: #d97706; }
.status.validated { background: #e6f9ed; color: #16a34a; }
.status.completed { background: #e5e8ff; color: #0e1577; }

/* --- Boutons --- */
.btn-validate {
    background: linear-gradient(135deg,#0e1577,#2865c2);
    color: #fff;
    border: none;
    padding: 7px 15px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 500;
    font-size: 13px;
    transition: all 0.3s;
}
.btn-validate:hover {
    background: linear-gradient(135deg,#2865c2,#0e1577);
    transform: scale(1.05);
}

/* --- Texte désactivé --- */
.text-muted { color: #999; font-style: italic; }

/* --- Aucune donnée --- */
.no-data { text-align: center; font-style: italic; color: #555; padding: 20px 0; }

/* --- Responsive --- */
@media (max-width:1024px){
    .deposits-table th, .deposits-table td { padding: 10px 8px; font-size: 13px; }
    .btn-validate { font-size: 12px; padding: 6px 12px; }
}
@media (max-width:768px){
    .filter-form { text-align: center; }
    .filter-form label { display:block; margin-bottom:8px; }
    .filter-form select { width: 100%; }

    .deposits-table { min-width: 720px; }
    .deposits-table th, .deposits-table td { font-size: 12px; padding: 8px 6px; }

    .status { font-size: 11px; padding: 4px 8px; }
}
@media (max-width:480px){
    .admin-container { padding: 15px; }
    .admin-container h2 { font-size: 20px; }

    .deposits-table { min-width: 600px; }
    .deposits-table th, .deposits-table td { font-size: 11px; padding: 6px 4px; }

    .status { font-size: 10px; padding: 3px 6px; }
    .btn-validate { font-size: 11px; padding: 5px 10px; }
}
</style>
@endsection
