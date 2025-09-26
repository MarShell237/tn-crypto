@extends('layouts.app')

@section('content')
<div class="users-list-container">
    <h2>Liste des utilisateurs</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="users-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Pays</th>
                    <th>Solde</th>
                    <th>Parrain</th>
                    <th>Filleuls</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->country ?? '-' }}</td>
                    <td>{{ number_format($user->balance, 2) }} €</td>
                    <td>{{ $user->referrer ? $user->referrer->name : '-' }}</td>
                    <td>{{ $user->referrals->count() }}</td>
                    <td class="actions-column">
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn-view">Voir</a>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-edit">Modifier</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $users->links() }}
    </div>
</div>

<style>
.users-list-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
    background: #fdfdfd;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    font-family: Arial, sans-serif;
}

.users-list-container h2 {
    text-align: center;
    color: #007BFF;
    margin-bottom: 25px;
}

.alert-success {
    background-color: #d1e7dd;
    color: #0f5132;
    padding: 12px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid #badbcc;
}

.table-responsive {
    overflow-x: auto;
}

.users-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.users-table th, .users-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    font-size: 0.95em;
}

.users-table th {
    background: #007BFF;
    color: #fff;
}

.users-table tr:nth-child(even) {
    background: #f9f9f9;
}

.users-table tr:hover {
    background: #f1f1f1;
}

.actions-column a,
.actions-column button {
    display: inline-block;
    margin: 2px;
    padding: 5px 10px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.85em;
    color: #fff;
    transition: background 0.3s;
}

.btn-view { background: #28a745; }
.btn-view:hover { background: #218838; }

.btn-edit { background: #ffc107; color: #212529; }
.btn-edit:hover { background: #e0a800; }

.btn-delete { background: #dc3545; border: none; cursor: pointer; }
.btn-delete:hover { background: #c82333; }

.inline-form { display: inline-block; margin: 0; }

.pagination {
    margin-top: 20px;
    text-align: center;
}

.pagination a, .pagination span {
    padding: 6px 12px;
    margin: 0 3px;
    border: 1px solid #007BFF;
    border-radius: 6px;
    text-decoration: none;
    color: #007BFF;
    font-size: 0.9em;
}

.pagination .active span {
    background: #007BFF;
    color: #fff;
    border: 1px solid #007BFF;
}
</style>
@endsection
