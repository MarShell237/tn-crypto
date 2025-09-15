@extends('layouts.app')

@section('content')
<h2>Liste des utilisateurs</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="8" cellspacing="0">
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
            <td>{{ $user->country }}</td>
            <td>{{ $user->balance }}</td>
            <td>{{ $user->referrer ? $user->referrer->name : '-' }}</td>
            <td>{{ $user->referrals->count() }}</td>
            <td>
                <a href="{{ route('admin.users.show', $user->id) }}">Voir</a> |
                <a href="{{ route('admin.users.edit', $user->id) }}">Modifier</a> |
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $users->links() }}

@endsection

