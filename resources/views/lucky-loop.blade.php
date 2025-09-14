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

    <!-- Modal -->
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
/* Styles conservés du code précédent... */

</style>

<script>
const wheel = document.getElementById('wheel');
const ctx = wheel.getContext('2d');

const segmentsBase = [
    { label: "Perdu", color: "#ff4d4f", weight: 3 },
    { label: "x2", color: "#28a745", weight: 1 },
    { label: "x2", color: "#28a745", weight: 1 },
    { label: "Code", color: "#ffc107", weight: 2 },
    { label: "x1", color: "#007bff", weight: 2 },
    { label: "Solde x2", color: "linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet)", weight: 1 }
];

let weightedSegments = [];
segmentsBase.forEach(seg => {
    for(let i=0;i<seg.weight;i++) weightedSegments.push({...seg});
});

function shuffleNoAdjacent(arr){
    let shuffled, attempts=0;
    do{
        shuffled = arr.sort(()=>Math.random()-0.5);
        attempts++;
    }while(hasAdjacent(shuffled) && attempts<1000);
    return shuffled;
}
function hasAdjacent(arr){
    for(let i=0;i<arr.length-1;i++){
        if(arr[i].color===arr[i+1].color) return true;
    }
    return false;
}
weightedSegments = shuffleNoAdjacent(weightedSegments);
const segments = weightedSegments;
const anglePerSegment = 2*Math.PI/segments.length;

function drawWheel(highlightIndex=null){
    ctx.clearRect(0,0,400,400);
    segments.forEach((seg,i)=>{
        ctx.beginPath();
        ctx.moveTo(200,200);
        ctx.arc(200,200,200,i*anglePerSegment,(i+1)*anglePerSegment);

        if(seg.color.includes("gradient")){
            const grad = ctx.createLinearGradient(0,0,400,0);
            grad.addColorStop(0,"red");
            grad.addColorStop(0.2,"orange");
            grad.addColorStop(0.4,"yellow");
            grad.addColorStop(0.6,"green");
            grad.addColorStop(0.8,"blue");
            grad.addColorStop(1,"violet");
            ctx.fillStyle = grad;
        } else ctx.fillStyle = seg.color;

        // Clignotement
        if(highlightIndex===i){
            ctx.fillStyle = "#ffff00";
        }

        ctx.fill();

        ctx.save();
        ctx.translate(200,200);
        ctx.rotate(i*anglePerSegment + anglePerSegment/2);
        ctx.fillStyle="#fff";
        ctx.font="bold 16px Arial";
        ctx.fillText(seg.label,120,0);
        ctx.restore();
    });
}
drawWheel();

let isSpinning=false;
document.getElementById('spin-btn').addEventListener('click', ()=>{
    if(isSpinning) return;
    isSpinning=true;

    const randomIndex = Math.floor(Math.random()*segments.length);
    const finalSegment = segments[randomIndex];

    const extraSpins = 5;
    const randomAngle = (360/segments.length)*randomIndex + 360*extraSpins + (360/(2*segments.length));

    wheel.style.transition="transform 5s cubic-bezier(0.33,1,0.68,1)";
    wheel.style.transform=`rotate(${randomAngle}deg)`;

    setTimeout(()=>{
        // Clignotement du segment choisi
        let blinkCount=0;
        const blinkInterval = setInterval(()=>{
            drawWheel(blinkCount%2===0 ? randomIndex : null);
            blinkCount++;
            if(blinkCount>5) clearInterval(blinkInterval);
        },300);

        showModal(finalSegment.label);

        // Sauvegarder le gain via AJAX
        fetch("{{ route('lucky-loop.spin') }}", {
            method:'POST',
            headers:{
                "Content-Type":"application/json",
                "X-CSRF-TOKEN":"{{ csrf_token() }}"
            },
            body: JSON.stringify({reward: finalSegment.label})
        }).then(res=>res.json())
          .then(data=>{
              if(data.success){
                  const ul = document.getElementById('wins-list');
                  const li = document.createElement('li');
                  li.textContent = "{{ auth()->user()->name }}" + " a gagné " + data.reward;
                  ul.prepend(li);
              }
          });

        isSpinning=false;
    },5000);
});

const modal=document.getElementById('winModal');
const modalTitle=document.getElementById('modalTitle');
const modalReward=document.getElementById('modalReward');
function showModal(reward){
    modalTitle.textContent="Félicitations !";
    modalReward.textContent=`Vous avez gagné : ${reward}`;
    modal.style.display='flex';
}
function closeModal(){ modal.style.display='none'; }
window.addEventListener('click', e=>{if(e.target===modal) closeModal();});
</script>
@endsection
