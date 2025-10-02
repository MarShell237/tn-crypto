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

    /* -------------------
       RESPONSIVE DESIGN
    ------------------- */
    @media (max-width: 768px) {
        .bonus-admin-card {
            padding: 10px;
        }
        .bonus-admin-card h2 {
            font-size: 20px;
        }
        .btn-generate {
            width: 100%;
            justify-content: center;
            font-size: 14px;
            padding: 10px;
        }
        table, thead, tbody, th, td, tr {
            display: block;
            width: 98%;
        }
        thead {
            display: none; /* cacher l'entête sur mobile */
        }
        tbody tr {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            background: #fafafa;
        }
        tbody td {
            text-align: left;
            padding: 8px 10px;
            border: none;
            display: flex;
            justify-content: space-between;
        }
        tbody td::before {
            content: attr(data-label);
            font-weight: bold;
            color: #007bff;
        }
        .btn-configure {
            width: 100%;
            justify-content: center;
            margin-top: 8px;
        }
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
                    <th>Code</th>
                    <th>Montant</th>
                    <th>Expiration</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bonuses as $bonus)
                    <tr>
                        <td data-label="Code">{{ $bonus->code }}</td>
                        <td data-label="Montant">{{ $bonus->amount ?? 'Non défini' }}</td>
                        <td data-label="Expiration">{{ $bonus->expires_at ?? 'Non défini' }}</td>
                        <td data-label="Actif">
                            @if($bonus->is_active)
                                <i class="fas fa-check-circle" style="color:green;"></i> Oui
                            @else
                                <i class="fas fa-times-circle" style="color:red;"></i> Non
                            @endif
                        </td>
                        <td data-label="Actions">
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
