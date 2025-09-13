@extends('layouts.app')

@section('title', 'Historique des retraits')

@section('content')
<div class="withdraw-container">
    <h1>Historique de mes retraits</h1>
    <p class="withdraw-intro">Consultez tous vos retraits effectués sur la plateforme avec leurs statuts et montants.</p>

    <!-- Carte du total retiré -->
    <div class="withdraw-summary">
        <h2>Total des retraits</h2>
        <p class="total-withdraw">0.00 BTC</p>
    </div>

    <!-- Tableau des retraits -->
    <div class="withdraw-table-container">
        <table class="withdraw-table">
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
                    <td>02/09/2025</td>
                    <td>0.005 BTC</td>
                    <td>Bitcoin</td>
                    <td><span class="status success">Validé</span></td>
                    <td>#WTH12345</td>
                </tr>
                <tr>
                    <td>29/08/2025</td>
                    <td>0.02 ETH</td>
                    <td>Ethereum</td>
                    <td><span class="status pending">En attente</span></td>
                    <td>#WTH12344</td>
                </tr>
                <tr>
                    <td>21/08/2025</td>
                    <td>0.5 LTC</td>
                    <td>Litecoin</td>
                    <td><span class="status failed">Échoué</span></td>
                    <td>#WTH12343</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
.withdraw-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 20px;
    font-family: 'Poppins', sans-serif;
}

.withdraw-container h1 {
    font-size: 32px;
    color: #0e1577ff;
    margin-bottom: 10px;
    text-align: center;
}

.withdraw-intro {
    font-size: 16px;
    color: #555;
    margin-bottom: 30px;
    text-align: center;
}

.withdraw-summary {
    background: linear-gradient(90deg, #ff6b6b, #ff4757);
    color: #fff;
    padding: 25px 20px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    margin-bottom: 40px;
    text-align: center;
}

.withdraw-summary h2 {
    font-size: 20px;
    margin-bottom: 15px;
}

.total-withdraw {
    font-size: 28px;
    font-weight: bold;
}

.withdraw-table-container {
    overflow-x: auto;
}

.withdraw-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.withdraw-table th, .withdraw-table td {
    padding: 15px;
    text-align: left;
    font-size: 14px;
}

.withdraw-table th {
    background-color: #ff4757;
    color: #fff;
    font-weight: 600;
}

.withdraw-table tbody tr:nth-child(even) {
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
    .withdraw-table th, .withdraw-table td {
        padding: 10px;
        font-size: 12px;
    }

    .withdraw-summary h2 {
        font-size: 18px;
    }

    .total-withdraw {
        font-size: 22px;
    }
}
</style>
@endsection
