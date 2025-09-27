@extends('layouts.app')

@section('content')
<style>
    .bonus-admin-wrapper {
        min-height: 90vh;
        background: #f5f7fa;
        padding: 40px 20px;
        display: flex;
        justify-content: center;
    }
    .bonus-admin-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        padding: 30px;
        width: 100%;
        max-width: 1000px;
    }
    .bonus-admin-card h2 {
        font-size: 26px;
        color: #2c3e50;
        margin-bottom: 25px;
        text-align: center;
    }
    .alert {
        border-radius: 10px;
        padding: 12px;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
    }
    .btn-generate {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 18px;
        background: #007bff;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-generate:hover {
        background: #0069d9;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
        font-size: 15px;
    }
    thead {
        background: #007bff;
        color: #fff;
    }
    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }
    tbody tr:hover {
        background: #f1f1f1;
    }
    .btn-configure {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ffc107;
        color: #212529;
        font-size: 14px;
        font-weight: bold;
        padding: 8px 14px;
        border-radius: 6px;
        text-decoration: none;
        transition: 0.3s;
    }
    .btn-configure:hover {
        background: #e0a800;
    }
</style>

<div class="bonus-admin-wrapper">
    <div class="bonus-admin-card">
        <h2><i class="fas fa-cogs"></i> Gestion des Bonus</h2>

        {{-- Message succès --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Bouton Générer --}}
        <form action="{{ route('bonus.generate') }}" method="POST">
            @csrf
            <button type="submit" class="btn-generate">
                <i class="fas fa-magic"></i> Générer un nouveau code
            </button>
        </form>

        {{-- Tableau --}}
        <table>
            <thead>
                <tr>
                    <th><i class="fas fa-ticket-alt"></i> Code</th>
                    <th><i class="fas fa-coins"></i> Montant</th>
                    <th><i class="far fa-clock"></i> Expiration</th>
                    <th><i class="fas fa-toggle-on"></i> Actif</th>
                    <th><i class="fas fa-tools"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bonuses as $bonus)
                    <tr>
                        <td>{{ $bonus->code }}</td>
                        <td>{{ $bonus->amount ?? 'Non défini' }}</td>
                        <td>{{ $bonus->expires_at ?? 'Non défini' }}</td>
                        <td>
                            @if($bonus->is_active)
                                <i class="fas fa-check-circle" style="color:green;"></i> Oui
                            @else
                                <i class="fas fa-times-circle" style="color:red;"></i> Non
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('bonus.edit', $bonus->id) }}" class="btn-configure">
                                <i class="fas fa-edit"></i> Configurer
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
