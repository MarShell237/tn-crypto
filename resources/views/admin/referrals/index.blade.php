@extends('layouts.app')

@section('content')
<div class="referrals-container">
    <h2>Liste des parrainages</h2>

    <table class="referrals-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Parrain</th>
                <th>Nombre de filleuls</th>
                <th>Filleuls</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usersWithReferrals as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->referrals->count() }}</td>
                <td>
                    @foreach($user->referrals as $referral)
                        {{ $referral->name }} ({{ $referral->email }})<br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $usersWithReferrals->links() }}
    </div>
</div>

<style>
.referrals-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 20px;
    background: #fdfdfd;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    font-family: Arial, sans-serif;
}

.referrals-container h2 {
    text-align: center;
    color: #007BFF;
    margin-bottom: 20px;
}

.referrals-table {
    width: 100%;
    border-collapse: collapse;
}

.referrals-table th, .referrals-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.referrals-table th {
    background: #007BFF;
    color: #fff;
}

.referrals-table tr:nth-child(even) {
    background: #f9f9f9;
}

.referrals-table tr:hover {
    background: #f1f1f1;
}

.pagination {
    margin-top: 15px;
    text-align: center;
}
</style>
@endsection
