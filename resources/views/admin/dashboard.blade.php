@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Navigation -->
    <nav class="admin-nav">
        <ul>
            <li><a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a></li>
            <li><a href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
            <li><a href="{{ route('admin.deposits.index') }}">Dépôts</a></li>
            <li><a href="#">Retraits</a></li>
            <li><a href="{{ route('admin.referrals.index') }}">Parrainages</a></li>
        </ul>
    </nav>

    <!-- Titre -->
    <h1>Tableau de bord Administrateur</h1>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="card">
            <h3>Utilisateurs</h3>
            <p>{{ $totalUsers }}</p>
        </div>
        <div class="card">
            <h3>Solde total</h3>
            <p>{{ number_format($totalBalance, 2) }} €</p>
        </div>
        <div class="card">
            <h3>Parrainages actifs</h3>
            <p>{{ $totalReferrals }}</p>
        </div>
        <div class="card">
            <h3>Nouveaux ce mois</h3>
            <p>{{ $newUsersThisMonth }}</p>
        </div>
    </div>

    <!-- Boutons actions -->
    <div class="actions">
        <a href="{{ route('admin.users.index') }}" class="btn">Gérer les utilisateurs</a>
    </div>
</div>

<style>
/* ====== NAVBAR ====== */
.admin-nav {
    background: #007BFF;
    padding: 10px 0;
    margin-bottom: 20px;
    border-radius: 5px;
}

.admin-nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
    margin: 0;
    padding: 0;
    gap: 20px;
}

.admin-nav ul li {
    display: inline;
}

.admin-nav ul li a {
    color: #fff;
    text-decoration: none;
    padding: 8px 15px;
    border-radius: 4px;
    transition: background 0.3s;
}

.admin-nav ul li a:hover {
    background: #0056b3;
}

.admin-nav ul li a.active {
    background: #fff;
    color: #007BFF;
    font-weight: bold;
}

/* ====== DASHBOARD ====== */
.dashboard-container {
    padding: 20px;
    font-family: Arial, sans-serif;
}

.dashboard-container h1 {
    margin-bottom: 20px;
    text-align: center;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.card {
    background: #f9f9f9;
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    transition: transform 0.2s ease;
}

.card:hover {
    transform: scale(1.05);
    background: #f0f0f0;
}

.card h3 {
    margin-bottom: 10px;
    color: #333;
}

.card p {
    font-size: 1.5em;
    font-weight: bold;
    color: #007BFF;
}

.actions {
    text-align: center;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background: #007BFF;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s;
}

.btn:hover {
    background: #0056b3;
}

.chart-container {
    width: 100%;
    max-width: 800px;
    margin: 0 auto 30px;
    padding: 20px;
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

</style>
<div class="chart-container">
    <canvas id="usersChart"></canvas>
</div>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Chart.js Zoom Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@2.0.1/dist/chartjs-plugin-zoom.min.js"></script>


<script>
const ctx = document.getElementById('usersChart').getContext('2d');

const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(0, 123, 255, 0.4)');
gradient.addColorStop(1, 'rgba(0, 123, 255, 0)');

const usersChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($months),
        datasets: [{
            label: 'Utilisateurs enregistrés',
            data: @json(array_values($usersPerMonth)),
            backgroundColor: gradient,
            borderColor: 'rgba(0, 123, 255, 1)',
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#fff',
            pointBorderColor: 'rgba(0, 123, 255, 1)',
            pointRadius: 6,
            pointHoverRadius: 8,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                labels: { color: '#007BFF', font: { weight: 'bold' } }
            },
            tooltip: { mode: 'index', intersect: false },
            zoom: {
                pan: {
                    enabled: true,
                    mode: 'x',
                    modifierKey: 'ctrl',
                },
                zoom: {
                    wheel: { enabled: true },
                    pinch: { enabled: true },
                    mode: 'x',
                }
            }
        },
        scales: {
            x: { 
                ticks: { color: '#333', font: { weight: 'bold' } },
                grid: { display: false }
            },
            y: {
                beginAtZero: true,
                ticks: { color: '#333', font: { weight: 'bold' } },
                grid: { color: 'rgba(0,0,0,0.05)' }
            }
        }
    }
});
</script>
<div style="text-align:center; margin-bottom: 20px;">
    <button onclick="usersChart.resetZoom()" class="btn">Réinitialiser Zoom</button>
</div>

@endsection
