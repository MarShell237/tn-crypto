@extends('layouts.app')

@section('title', 'Équipe')

@section('content')
<div class="team-container">

    <h2>Parrainez vos amis</h2>
    <p class="team-intro">Partagez votre code ou votre lien pour inviter des amis.</p>

    <!-- Bloc d'invitation -->
    <div class="invite-container">
        <div class="invite-card">
            <h3>Code d'invitation</h3>
            <div class="input-copy">
                <input type="text" id="invite-code" value="123456M" readonly>
                <button onclick="copyText('invite-code')"><i class="fas fa-copy"></i> Copier</button>
            </div>
        </div>

        <div class="invite-card">
            <h3>Lien de parrainage</h3>
            <div class="input-copy">
                <input type="text" id="invite-link" value="http://example.com/register?ref=123456M" readonly>
                <button onclick="copyText('invite-link')"><i class="fas fa-copy"></i> Copier</button>
            </div>
        </div>
    </div>

    <!-- Notification temporaire -->
    <div class="copy-alert" id="copy-alert">Copié avec succès !</div>

    <!-- Section niveaux -->
    <div class="levels-container">
        <div class="level-card">
            <h3>Niveau A <span>20%</span></h3>
            <p class="level-count">0</p>
        </div>
        <div class="level-card">
            <h3>Niveau B <span>40%</span></h3>
            <p class="level-count">0</p>
        </div>
        <div class="level-card">
            <h3>Niveau C <span>2%</span></h3>
            <p class="level-count">0</p>
        </div>
    </div>
</div>

<style>
.team-container {
    max-width: 900px;
    margin: 50px auto;
    padding: 0 20px;
    text-align: center;
    font-family: 'Poppins', sans-serif;
}

.team-container h2 {
    font-size: 32px;
    margin-bottom: 10px;
    color: #0e1577ff;
}

.team-container .team-intro {
    font-size: 16px;
    color: #555;
    margin-bottom: 40px;
}

/* Bloc d'invitation */
.invite-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.invite-card {
    background: #fff;
    flex: 1 1 300px;
    width: 270px;
    padding: 2px 20px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.invite-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}

.invite-card h3 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #0e1577ff;
}

.input-copy {
    display: flex;
    gap: 10px;
}

.input-copy input {
    flex: 1;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 14px;
    outline: none;
}

.input-copy button {
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(45deg, #ff9800, #ffb74d);
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}

.input-copy button:hover {
    background: linear-gradient(45deg, #ffb74d, #ff9800);
    transform: scale(1.05);
}

/* Notification temporaire */
.copy-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #0e1577ff;
    color: #fff;
    padding: 12px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
    z-index: 1000;
}

.copy-alert.show {
    opacity: 1;
}

/* Section niveaux */
.levels-container {
    display: flex;
    gap: 20px;
    justify-content: center;
    margin-top: 50px;
    flex-wrap: wrap;
}

.level-card {
    background: #e0f0ff;
    flex: 1 1 200px;
    max-width: 250px;
    padding: 25px 20px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    text-align: center;
}

.level-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 22px rgba(0,0,0,0.15);
}

.level-card h3 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #0e1577ff;
}

.level-card h3 span {
    font-weight: normal;
    font-size: 14px;
    color: #555;
}

.level-count {
    font-size: 32px;
    font-weight: bold;
    color: #0e1577ff;
}
.invite-card,
.level-card {
    min-height: 150px; /* hauteur normale */
}
/* Responsive */
@media(max-width: 768px) {
    .invite-container,
    .levels-container {
        flex-direction: column;
        align-items: stretch; /* pour prendre toute la largeur */
    }

     .invite-card,
    .level-card
     {
        max-height: 90px; /* 2x moins haut */
    }
    .level-card{
        padding: 0;
        justify-content: center;
    }
    .input-copy {
        flex-direction: column; /* inputs et boutons l’un au-dessus de l’autre */
    }

    .input-copy button {
        width: 100%; /* bouton pleine largeur pour mobile */
    }
}

</style>

<script>
function copyText(id) {
    const text = document.getElementById(id);
    text.select();
    text.setSelectionRange(0, 99999); // pour mobile
    navigator.clipboard.writeText(text.value).then(() => {
        const alertBox = document.getElementById('copy-alert');
        alertBox.classList.add('show');
        setTimeout(() => {
            alertBox.classList.remove('show');
        }, 2000); // 2 secondes
    });
}
</script>
@endsection
