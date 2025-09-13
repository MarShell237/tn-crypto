@extends('layouts.app')

@section('title', 'Bonus')

@section('content')
<div class="bonus-container">
    <h2>Bonus</h2>

    <div class="bonus-card">
        <h3>Utiliser un code cadeau</h3>

        <div class="bonus-input">
            <input type="text" placeholder="Collez votre code ici" id="bonus-code">
            <button onclick="submitBonus()">Soumettre</button>
        </div>

        <!-- Notification -->
        <div id="bonus-alert" class="bonus-alert" style="display:none;">
            Code soumis avec succès !
        </div>
    </div>
</div>

<style>
.bonus-container {
    max-width: 600px;
    margin: 50px auto;
    padding: 0 20px;
    text-align: center;
    font-family: 'Poppins', sans-serif;
}

.bonus-container h2 {
    font-size: 45px;
    margin-bottom: 30px;
    color: #0e1577ff;
}

.bonus-card {
    background: #fff;
    padding: 30px 25px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.bonus-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.bonus-card h3 {
    font-size: 20px;
    margin-bottom: 20px;
    color: #0e1577ff;
}

.bonus-input {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.bonus-input input {
    flex: 1 1 250px;
    padding: 12px 15px;
    border-radius: 10px;
    border: 1px solid #ccc;
    font-size: 16px;
}

.bonus-input button {
    padding: 12px 25px;
    background: linear-gradient(45deg, #ff9800, #ffb74d);
    color: #fff;
    font-weight: bold;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s;
}

.bonus-input button:hover {
    background: linear-gradient(45deg, #ffb74d, #ff9800);
    transform: scale(1.05);
}

/* Notification alert */
.bonus-alert {
    margin-top: 15px;
    padding: 12px;
    background-color: #28a745;
    color: #fff;
    font-weight: 600;
    border-radius: 8px;
    opacity: 0;
    transition: opacity 0.3s;
}

/* Responsive */
@media(max-width: 480px) {
    .bonus-input {
        flex-direction: column;
    }
}
</style>

<script>
function submitBonus() {
    const codeInput = document.getElementById('bonus-code');
    const alertBox = document.getElementById('bonus-alert');

    if(codeInput.value.trim() === '') return;

    // Afficher la notification
    alertBox.style.display = 'block';
    alertBox.style.opacity = '1';

    // Masquer après 3 secondes
    setTimeout(() => {
        alertBox.style.opacity = '0';
        setTimeout(() => { alertBox.style.display = 'none'; }, 300);
    }, 3000);

    // Réinitialiser le champ
    codeInput.value = '';
}
</script>
@endsection
