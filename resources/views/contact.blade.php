@extends('layouts.app')

@section('title', 'Contactez-nous')

@section('content')
<div class="contact-container">
    <h2 class="contact-title"><i class="fas fa-headset"></i> Contactez notre support</h2>
    <p class="intro-text">
        Notre équipe est à votre disposition pour toute question, présentation de la plateforme ou assistance technique.  
        N’hésitez pas à nous joindre via les canaux ci-dessous :
    </p>

    <div class="contact-grid">
        <!-- Telegram -->
        <div class="contact-card">
            <i class="fab fa-telegram-plane contact-icon"></i>
            <h3>Canal Telegram</h3>
            <p>Rejoignez notre communauté officielle</p>
            <a href="https://t.me/Cryptonewinves" target="_blank" class="btn-telegram">
                <i class="fab fa-telegram-plane"></i> Rejoindre
            </a>
        </div>
        <!-- Telegram -->
        <div style="background:#fff; border-radius:12px; padding:20px; text-align:center; 
                    box-shadow:0 4px 12px rgba(0,0,0,0.1); max-width:250px; margin:auto;">
            
            <i class="fab fa-telegram-plane" style="font-size:40px; margin-bottom:10px; color:#0088cc;"></i>
            <h3>Chat Telegram 1</h3>
            <p>Contactez nous sur Telegram</p>
            
            <a href="https://t.me/@ChatCryptoinvests" target="_blank" 
            style="display:inline-block; padding:10px 18px; margin-top:10px; 
                    background-color:#0088cc; color:white; font-weight:bold; 
                    border-radius:25px; text-decoration:none;">
                <i class="fab fa-telegram-plane" style="margin-right:8px;"></i> Rejoindre
            </a>
        </div>
        <!-- Telegram -->
        <div style="background:#fff; border-radius:12px; padding:20px; text-align:center; 
                    box-shadow:0 4px 12px rgba(0,0,0,0.1); max-width:250px; margin:auto;">
            
            <i class="fab fa-telegram-plane" style="font-size:40px; margin-bottom:10px; color:#0088cc;"></i>
            <h3>Chat Telegram 2</h3>
            <p>Contactez nous sur Telegram</p>
            
            <a href="https://t.me/invest1162" target="_blank" 
            style="display:inline-block; padding:10px 18px; margin-top:10px; 
                    background-color:#0088cc; color:white; font-weight:bold; 
                    border-radius:25px; text-decoration:none;">
                <i class="fab fa-telegram-plane" style="margin-right:8px;"></i> Rejoindre
            </a>
        </div>

        <!-- whatsapp -->
        <div style="background:#fff; border-radius:12px; padding:20px; text-align:center; 
                    box-shadow:0 4px 12px rgba(0,0,0,0.1); max-width:250px; margin:auto;">
            
            <i class="fab fa-whatsapp" style="font-size:40px; margin-bottom:10px; color:#25D366;"></i>
            <h3>WhatsApp 1</h3>
            <p>Contactez-nous sur WhatsApp</p>
            
            <a href="https://wa.me/6564925096" target="_blank" 
            style="display:inline-block; padding:10px 18px; margin-top:10px; 
                    background-color:#25D366; color:white; font-weight:bold; 
                    border-radius:25px; text-decoration:none;">
                <i class="fab fa-whatsapp" style="margin-right:8px;"></i> WhatsApp 
            </a>
        </div>

        <!-- whatsapp -->
        <div style="background:#fff; border-radius:12px; padding:20px; text-align:center; 
                    box-shadow:0 4px 12px rgba(0,0,0,0.1); max-width:250px; margin:auto;">
            
            <i class="fab fa-whatsapp" style="font-size:40px; margin-bottom:10px; color:#25D366;"></i>
            <h3>WhatsApp 2</h3>
            <p>Contactez-nous sur WhatsApp</p>

            <a href="https://wa.me/237651386884" target="_blank" 
            style="display:inline-block; padding:10px 18px; margin-top:10px; 
                    background-color:#25D366; color:white; font-weight:bold; 
                    border-radius:25px; text-decoration:none;">
                <i class="fab fa-whatsapp" style="margin-right:8px;"></i> WhatsApp
            </a>
        </div>


    </div>

    <div class="call-us">
        <i class="fas fa-phone-volume"></i>  
        Vous pouvez aussi nous <strong>appeler directement</strong> pour toute présentation détaillée de la plateforme ou en cas de souci.  
    </div>
</div>

<!-- Styles -->
<style>
.contact-container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 40px 20px;
    text-align: center;
}

.contact-title {
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 20px;
    color: #0e1577;
}

.intro-text {
    font-size: 1.1rem;
    color: #555;
    margin-bottom: 40px;
}

.contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.contact-card {
    background: #fff;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
}

.contact-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.contact-icon {
    font-size: 3rem;
    color: #0e1577;
    margin-bottom: 15px;
}

.contact-card h3 {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 10px;
    color: #222;
}

.contact-card p {
    margin: 8px 0;
    font-size: 1rem;
    color: #444;
}

.btn-telegram {
    display: inline-block;
    margin-top: 12px;
    padding: 10px 20px;
    background: #0088cc;
    color: #fff;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s, transform 0.2s;
}
.btn-telegram:hover {
    background: #006f9b;
    transform: scale(1.05);
}

.call-us {
    background: #f4f6f8;
    border-left: 5px solid #0e1577;
    padding: 20px;
    font-size: 1.1rem;
    color: #333;
    border-radius: 10px;
    text-align: left;
    max-width: 800px;
    margin: 0 auto;
}
.call-us i {
    color: #0e1577;
    margin-right: 8px;
}
</style>
@endsection
