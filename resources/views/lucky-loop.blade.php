@extends('layouts.app')

@section('title', 'Lucky Loop')

@section('content')
<div class="lucky-loop-container">

    <div class="loop-header">
        <h1> Lucky Loop</h1>
        <p>Tournez la roue et tentez votre chance pour remporter des récompenses incroyables !</p>
        <h5>Malheureusement cette fonctionnalité est encore en développement.</h5>
    </div>

    <div class="loop-grid">
        <div class="wheel-wrapper">
            <div class="wheel-pointer"></div>
            <canvas id="wheel" width="400" height="400"></canvas>
            <button id="spin-btn">🎡 TOURNER</button>
        </div>
    </div>

</div>

<style>
.lucky-loop-container {
    max-width: 1000px;
    margin: 60px auto;
    padding: 20px;
    font-family: 'Poppins', sans-serif;
    text-align: center;
    background: linear-gradient(135deg, #1b1b1b, #222);
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
    color: #fff;
    overflow: hidden;
}

.loop-header h1 {
    font-size: 2.8rem;
    font-weight: 700;
    background: linear-gradient(90deg, #f39c12, #f1c40f);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 10px;
}

.loop-header p {
    font-size: 1.1rem;
    color: #bbb;
    margin-bottom: 40px;
}

.loop-grid {
    display: flex;
    justify-content: center;
}

.wheel-wrapper {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: rgba(255, 255, 255, 0.05);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease-in-out;
}

.wheel-wrapper:hover {
    transform: scale(1.02);
}

#wheel {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 0 auto;
    border-radius: 50%;
    border: 8px solid #f39c12;
    box-shadow: 0 0 30px rgba(255, 193, 7, 0.7);
    background: radial-gradient(circle, #333 30%, #000);
}

.wheel-pointer {
    width: 0; 
    height: 0; 
    border-left: 20px solid transparent;
    border-right: 20px solid transparent;
    border-bottom: 40px solid #f1c40f;
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    filter: drop-shadow(0 0 5px #ff0);
}

#spin-btn {
    margin-top: 30px;
    padding: 15px 40px;
    font-size: 1.2rem;
    font-weight: bold;
    background: linear-gradient(90deg, #f39c12, #f1c40f);
    border: none;
    border-radius: 50px;
    color: #000;
    cursor: pointer;
    box-shadow: 0 6px 15px rgba(255, 193, 7, 0.5);
    transition: all 0.3s ease-in-out;
}

#spin-btn:hover {
    transform: scale(1.1);
    filter: brightness(1.1);
}

@media (max-width: 600px) {
    .lucky-loop-container {
        transform: scale(0.9);
        padding: 15px;
    }

    #spin-btn {
        width: 100%;
        font-size: 1rem;
    }
}
</style>


<script>
const wheel = document.getElementById('wheel');
const ctx = wheel.getContext('2d');
const modal = document.getElementById('result-modal');
const resultText = document.getElementById('result-text');
const closeModal = document.getElementById('close-modal');

const segmentsBase = [
    { label: "Perdu 😢", color: "#ff4d4f", weight: 3 },
    { label: "x2 💰", color: "#28a745", weight: 1 },
    { label: "x2 💰", color: "#28a745", weight: 1 },
    { label: "Code 🎁", color: "#ffc107", weight: 2 },
    { label: "x1 🔁", color: "#007bff", weight: 2 },
    { label: "Solde x2 💵", color: "#ff0", weight: 1 }
];

// pondération
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

        // Attendre 5 secondes avant d'afficher le modal
        setTimeout(()=>{
            resultText.textContent = `Vous avez gagné : ${finalSegment.label}`;
            modal.classList.remove('hidden');
        }, 5000);

        isSpinning=false;
    },5000);
});

closeModal.addEventListener('click', ()=>{
    modal.classList.add('hidden');
});
</script>

<!-- Import de SweetAlert2 pour la popup élégante -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
