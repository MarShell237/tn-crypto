@extends('layouts.app')

@section('content')
<div class="chat-container" style="
    max-width:600px;
    margin:50px auto;
    border:1px solid #ccc;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    padding:15px;
    background:#f9f9f9;
">
    <h3 style="text-align:center;margin-bottom:15px;">💬 Chat en direct</h3>

    <div id="messages" style="
        border:1px solid #ddd;
        border-radius:6px;
        height:400px;
        overflow-y:auto;
        padding:10px;
        background:#fff;
    ">
        @foreach($messages as $msg)
            <p style="margin:5px 0;">
                <strong>{{ $msg->user->name }}:</strong> {{ $msg->message }}
            </p>
        @endforeach
    </div>

    <div style="display:flex;margin-top:10px;">
        <input 
            type="text" 
            id="chat-input" 
            placeholder="Écrire un message..." 
            style="
                flex:1;
                padding:10px;
                border:1px solid #ccc;
                border-radius:6px 0 0 6px;
                outline:none;
                font-size:14px;
                transition:border 0.3s;
            "
            onfocus="this.style.border='1px solid #27ae60';"
            onblur="this.style.border='1px solid #ccc';"
        >
        <button 
            id="send-btn" 
            style="
                padding:10px 15px;
                border:none;
                background:#27ae60;
                color:white;
                font-weight:bold;
                border-radius:0 6px 6px 0;
                cursor:pointer;
                transition:background 0.3s;
            "
            onmouseover="this.style.background='#219150';"
            onmouseout="this.style.background='#27ae60';"
        >Envoyer</button>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://js.pusher.com/8.0/pusher.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    const input = document.getElementById('chat-input');
    const btn = document.getElementById('send-btn');
    const messages = document.getElementById('messages');

    // Envoyer un message
    btn.addEventListener('click', () => {
        if(input.value.trim() === '') return;

        fetch('{{ route('chat.send') }}', {
            method: 'POST',
            headers: {
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: input.value })
        }).then(res => {
            if(res.ok) input.value = '';
        });
    });

    // Écouter les événements en temps réel
    window.Echo.channel('chat')
        .listen('NewMessage', (e) => {
            messages.innerHTML += `
                <p style="margin:5px 0;">
                    <strong>${e.message.user.name}:</strong> ${e.message.message}
                </p>`;
            messages.scrollTop = messages.scrollHeight;
        });
</script>
@endsection
