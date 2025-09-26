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
                <input type="text" id="invite-code" value="{{ auth()->user()->referral_code }}" readonly>
                <button onclick="copyText('invite-code')"><i class="fas fa-copy"></i> Copier</button>
            </div>
        </div>

        <div class="invite-card">
            <h3>Lien de parrainage</h3>
            <div class="input-copy">
                <input type="text" id="invite-link" value="{{ url('/register') . '?ref=' . auth()->user()->referral_code }}" readonly>
                <button onclick="copyText('invite-link')"><i class="fas fa-copy"></i> Copier</button>
            </div>
        </div>
    </div>

</div>
    <!-- Notification temporaire -->
    <div class="copy-alert" id="copy-alert">Copié avec succès !</div>

    <!-- Section niveaux -->
    <div class="levels-container">
        <div class="level-card">
            <h3>Niveau A <span>{{ $niveauA }}</span></h3>
            <p class="level-count">{{ $niveauA }} filleuls</p>
        </div>
        <div class="level-card">
            <h3>Niveau B <span>{{ $niveauB }}</span></h3>
            <p class="level-count">{{ $niveauB }} filleuls</p>
        </div>
        <div class="level-card">
            <h3>Niveau C <span>{{ $niveauC }}</span></h3>
            <p class="level-count">{{ $niveauC }} filleuls</p>
        </div>
    </div>

    <!-- Section progression partenaire -->
    <div class="partner-progress">
        <h3>Progression vers Partenaire</h3>
        <p>{{ $directReferralsCount }} / 50 filleuls directs</p>
        <div class="progress-bar">
            <div class="progress-fill" style="width: {{ $progress }}%">
                <span class="progress-text">{{ $progress }}%</span>
            </div>
        </div>
        @if($directReferralsCount >= 50)
            <p class="status success">🎉 Félicitations ! Vous êtes devenu Partenaire.</p>
        @else
            <p class="status">Encore {{ 50 - $directReferralsCount }} filleuls pour devenir Partenaire.</p>
        @endif
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

/* Progression partenaire */
.partner-progress {
    margin-top: 50px;
    text-align: center;
    background: #fff;
    padding: 25px 20px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
}

.partner-progress h3 {
    font-size: 20px;
    margin-bottom: 15px;
    color: #0e1577ff;
}

.progress-bar {
    width: 100%;
    max-width: 500px;
    height: 30px;
    background: #e0e0e0;
    border-radius: 10px;
    margin: 15px auto;
    overflow: hidden;
    position: relative;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #0e1577ff, #3a8dff);
    transition: width 0.5s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
}

.progress-text {
    position: absolute;
    width: 100%;
    text-align: center;
    font-size: 12px;
    font-weight: bold;
    color: #fff;
}

.status {
    font-size: 15px;
    margin-top: 10px;
    color: #555;
}

.status.success {
    font-weight: bold;
    color: green;
}

/* Responsive */
.invite-card,
.level-card {
    min-height: 150px; /* hauteur normale */
}

@media(max-width: 768px) {
    .invite-container,
    .levels-container {
        flex-direction: column;
        align-items: stretch;
    }

    .invite-card,
    .level-card {
        max-height: 90px; /* 2x moins haut */
    }

    .level-card {
        padding: 0;
        justify-content: center;
    }

    .input-copy {
        flex-direction: column;
    }

    .input-copy button {
        width: 100%;
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
