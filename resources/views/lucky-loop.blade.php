@extends('layouts.app')

@section('title', 'Lucky Loop')

@section('content')
<div class="lucky-loop-container">

    <!-- Header -->
    <div class="loop-header">
        <h1>Lucky Loop</h1>
        <p>Tournez la roue et remportez vos récompenses !</p>
    </div>

    <!-- Roulette interactive -->
    <div class="wheel-wrapper" style="position: relative; display: inline-block;">
        <!-- Marqueur triangle inversé -->
        <div class="wheel-pointer"></div>
        <canvas id="wheel" width="400" height="400"></canvas>
        <button id="spin-btn">TOURNER</button>
    </div>

    <!-- Historique des gains récents -->
    <div class="recent-wins">
        <h3> Vos Gains</h3>
        <ul id="wins-list">
            @foreach($recentWins as $win)
                <li>{{ $win->user_name }} a gagné {{ $win->reward }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Modal personnalisé -->
    <div id="winModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Félicitations !</h2>
            <p id="modalReward">Vous avez gagné : </p>
            <button onclick="closeModal()">Fermer</button>
        </div>
    </div>

</div>

<style>
.lucky-loop-container { text-align: center; padding: 20px; position: relative; }
.loop-header h1 { color: #ff9800; font-size: 2.5rem; margin-bottom: 10px; }
.loop-header p { font-size: 1.2rem; color: #1e1e2f; }

.wheel-wrapper { position: relative; margin: 30px auto; width: 100%; max-width: 400px; }
#wheel { border-radius: 50%; box-shadow: 0 8px 20px rgba(0,0,0,0.3); transition: transform 5s cubic-bezier(0.33,1,0.68,1); }
#spin-btn { margin-top: 20px; padding: 15px 25px; background-color: #3a8dff; color: #fff; font-size: 1.2rem; border: none; border-radius: 10px; cursor: pointer; transition: all 0.3s; }
#spin-btn:hover { background-color: #0d6efd; transform: scale(1.05); }

/* Triangle inversé */
.wheel-pointer {
    position: absolute;
    top: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 12px solid transparent;
    border-right: 12px solid transparent;
    border-top: 20px solid #ff0000; /* pointe vers le bas */
    z-index: 10;
}

.recent-wins { margin-top: 40px; text-align: left; max-width: 500px; margin-left: auto; margin-right: auto; background: #f8f8f8; padding: 15px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
.recent-wins ul { list-style: none; padding: 0; margin: 0; }
.recent-wins li { padding: 8px 0; border-bottom: 1px solid #ddd; }
.recent-wins li:last-child { border-bottom: none; }

/* Modal */
.modal { display: none; position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); display: flex; justify-content: center; align-items: center; }
.modal-content { background: #fff; padding: 30px; border-radius: 15px; text-align: center; max-width: 400px; width: 80%; box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
.modal-content h2 { color: #ff9800; margin-bottom: 15px; }
.modal-content p { font-size: 1.2rem; margin-bottom: 20px; }
.modal-content button { padding: 12px 25px; background-color: #3a8dff; color: #fff; border: none; border-radius: 10px; font-weight: bold; cursor: pointer; }
.modal-content button:hover { background-color: #0d6efd; }
.close-btn { position: absolute; top: 10px; right: 15px; font-size: 1.5rem; cursor: pointer; color: #ff4d4f; }

@media(max-width:768px) {
    .wheel-wrapper canvas{
        width: 89%;
    }
}
</style>

<script>
// Données de la roue (désordre)
const wheel = document.getElementById('wheel');
const ctx = wheel.getContext('2d');

// Segments mélangés
const segments = [
    {label:"x2", color:"#28a745"},
    {label:"Perdu", color:"#ff4d4f"},
    {label:"x1", color:"#007bff"},
    {label:"Code", color:"#ffc107"},
    {label:"Perdu", color:"#ff4d4f"},
    {label:"x2", color:"#28a745"},
    {label:"Code", color:"#ffc107"},
    {label:"x2", color:"linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet)"}
];

const anglePerSegment = 2 * Math.PI / segments.length;

// Dessiner la roue
function drawWheel(){
    segments.forEach((seg, i) => {
        ctx.beginPath();
        ctx.moveTo(200,200);
        ctx.arc(200,200,200,i*anglePerSegment,(i+1)*anglePerSegment);

        // Couleur arc-en-ciel
        if(seg.color.includes("gradient")){
            const grad = ctx.createLinearGradient(0,0,400,0);
            grad.addColorStop(0,"red");
            grad.addColorStop(0.2,"orange");
            grad.addColorStop(0.4,"yellow");
            grad.addColorStop(0.6,"green");
            grad.addColorStop(0.8,"blue");
            grad.addColorStop(1,"violet");
            ctx.fillStyle = grad;
        } else {
            ctx.fillStyle = seg.color;
        }
        ctx.fill();

        ctx.save();
        ctx.translate(200,200);
        ctx.rotate(i*anglePerSegment + anglePerSegment/2);
        ctx.fillStyle = "#fff";
        ctx.font = "bold 16px Arial";
        ctx.fillText(seg.label, 120, 0);
        ctx.restore();
    });
}
drawWheel();

// Spin animation avec modal
let isSpinning = false;
document.getElementById('spin-btn').addEventListener('click', () => {
    if(isSpinning) return;
    isSpinning = true;

    const spins = Math.floor(Math.random()*5)+5;
    const randomSegment = Math.floor(Math.random()*segments.length);
    const finalRotation = spins*360 + randomSegment*(360/segments.length);

    wheel.style.transition = "transform 5s cubic-bezier(0.33,1,0.68,1)";
    wheel.style.transform = `rotate(${finalRotation}deg)`;

    setTimeout(() => {
        showModal(segments[randomSegment].label);
        isSpinning = false;
    }, 5000);
});

// Modal
const modal = document.getElementById('winModal');
const modalTitle = document.getElementById('modalTitle');
const modalReward = document.getElementById('modalReward');

function showModal(reward) {
    modalTitle.textContent = "Félicitations ! ";
    modalReward.textContent = `Vous avez gagné : ${reward}`;
    modal.style.display = 'flex';
}

function closeModal() {
    modal.style.display = 'none';
}

window.addEventListener('click', function(event){
    if(event.target === modal) closeModal();
});
</script>
@endsection
