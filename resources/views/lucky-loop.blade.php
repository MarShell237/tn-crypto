@extends('layouts.app')

@section('title', 'Lucky Loop')

@section('content')
<div class="lucky-loop-container">

    <div class="loop-header">
        <h1>Lucky Loop</h1>
        <p>Tournez la roue et remportez vos récompenses !</p>
    </div>

    <div class="loop-grid">
        <div class="wheel-wrapper">
            <div class="wheel-pointer"></div>
            <canvas id="wheel" width="400" height="400"></canvas>
            <button id="spin-btn">TOURNER</button>
        </div>
    </div>

</div>

<style>
.lucky-loop-container {
    max-width: 1100px;
    margin: 50px auto;
    padding: 0 15px;
    font-family: 'Arial', sans-serif;
    transform: scale(0.8);
}
.loop-header{
    justify-content: center;
    text-align: center;

}
.loop-header h1 {
    font-size: 2.5rem;
    color: #007bff;
    margin-bottom: 10px;
}
.loop-header p {
    font-size: 1.2rem;
    color: #555;
    margin-bottom: 30px;
}

.loop-grid {
    display: flex;
    justify-content: center; /* centre la roue horizontalement */
}

.wheel-wrapper {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
}

#wheel {
    max-width: 100%; /* permet de réduire le canvas sur petits écrans */
    height: auto;
    display: block;
    margin: 0 auto;
    border-radius: 50%;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}


#spin-btn:hover {
    transform: scale(1.05);
    filter: brightness(90%);
}
</style>

<script>
// Gestion de la roue inchangée
const wheel = document.getElementById('wheel');
const ctx = wheel.getContext('2d');

const segmentsBase = [
    { label: "Perdu", color: "#ff4d4f", weight: 3 },
    { label: "x2", color: "#28a745", weight: 1 },
    { label: "x2", color: "#28a745", weight: 1 },
    { label: "Code", color: "#ffc107", weight: 2 },
    { label: "x1", color: "#007bff", weight: 2 },
    { label: "Solde x2", color: "#ff0", weight: 1 }
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
        ctx.fillStyle = seg.color;
        if(highlightIndex===i) ctx.fillStyle = "#ffff00";
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
        let blinkCount=0;
        const blinkInterval = setInterval(()=>{
            drawWheel(blinkCount%2===0 ? randomIndex : null);
            blinkCount++;
            if(blinkCount>5) clearInterval(blinkInterval);
        },300);

        alert(`Vous avez gagné : ${finalSegment.label}`); // simple modal pour test
        isSpinning=false;
    },5000);
});
</script>
@endsection
