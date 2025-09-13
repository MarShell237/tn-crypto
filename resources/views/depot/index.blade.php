@extends('layouts.app')

@section('title', 'Historique des dépôts')

@section('content')
<div class="deposit-container">
    <h1>Historique de mes dépôts</h1>
    <p class="deposit-intro">Consultez tous vos dépôts effectués sur la plateforme avec leurs statuts et montants.</p>

    <!-- Carte du solde total -->
    <div class="deposit-summary">
        <h2>Solde total des dépôts</h2>
        <p class="total-deposit">0.00 BTC</p>
    </div>

    <!-- Tableau des dépôts -->
    <div class="deposit-table-container">
        <table class="deposit-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Montant</th>
                    <th>Crypto</th>
                    <th>Statut</th>
                    <th>Référence</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01/09/2025</td>
                    <td>0.01 BTC</td>
                    <td>Bitcoin</td>
                    <td><span class="status success">Validé</span></td>
                    <td>#DEP12345</td>
                </tr>
                <tr>
                    <td>28/08/2025</td>
                    <td>0.05 ETH</td>
                    <td>Ethereum</td>
                    <td><span class="status pending">En attente</span></td>
                    <td>#DEP12344</td>
                </tr>
                <tr>
                    <td>20/08/2025</td>
                    <td>1 LTC</td>
                    <td>Litecoin</td>
                    <td><span class="status failed">Échoué</span></td>
                    <td>#DEP12343</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
.deposit-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 20px;
    font-family: 'Poppins', sans-serif;
}

.deposit-container h1 {
    font-size: 32px;
    color: #0e1577ff;
    margin-bottom: 10px;
    text-align: center;
}

.deposit-intro {
    font-size: 16px;
    color: #555;
    margin-bottom: 30px;
    text-align: center;
}

.deposit-summary {
    background: linear-gradient(90deg, #3a8dff, #0e1577ff);
    color: #fff;
    padding: 25px 20px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    margin-bottom: 40px;
    text-align: center;
}

.deposit-summary h2 {
    font-size: 20px;
    margin-bottom: 15px;
}

.total-deposit {
    font-size: 28px;
    font-weight: bold;
}

.deposit-table-container {
    overflow-x: auto;
}

.deposit-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.deposit-table th, .deposit-table td {
    padding: 15px;
    text-align: left;
    font-size: 14px;
}

.deposit-table th {
    background-color: #0e1577ff;
    color: #fff;
    font-weight: 600;
}

.deposit-table tbody tr:nth-child(even) {
    background: #f8f8f8;
}

.status {
    padding: 5px 10px;
    border-radius: 8px;
    color: #fff;
    font-weight: bold;
    font-size: 12px;
}

.status.success { background-color: #28a745; }
.status.pending { background-color: #ffc107; color: #000; }
.status.failed { background-color: #dc3545; }

@media(max-width: 768px) {
    .deposit-table th, .deposit-table td {
        padding: 10px;
        font-size: 12px;
    }

    .deposit-summary h2 {
        font-size: 18px;
    }

    .total-deposit {
        font-size: 22px;
    }
}
</style>
@endsection
