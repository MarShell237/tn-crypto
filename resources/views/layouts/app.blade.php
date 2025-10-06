<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>{{ config('app.name') }}</title>

    <!-- Font Awesome CDN pour emojis/icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <a href="https://www.flaticon.com/free-icons/litecoin" title="Litecoin icons">Litecoin icons created by riajulislam - Flaticon</a> -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon-bitcoin.ico.png') }}">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            overflow: hidden; /* empêche le scroll */
            height: 100%;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        main {
            padding: 20px 30px;
            height: calc(100vh - 100px);
            overflow-y: auto;
        }

        /* Solde total en haut à droite */
        .balance-container {
            position: fixed;
            top: 10px;
            right: 20%;
            background: blue;
            color: #fff;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            z-index: 1001;
        }

        /* Footer fixe avec emojis */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: #ffffff;
            box-shadow: 0 -2px 15px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            z-index: 1000;
            padding: 0 40px;
        }

        .footer-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-weight: 600;
            text-align: center;
        }

        .footer-link i {
            font-size: 24px; /* taille de l’emoji/icône */
            margin-bottom: 5px;
            color:  #F7931A;
        }

        .footer-link a {
            padding: 10px 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: #f0f0f0;
        }

        .footer-link a:hover {
            background: linear-gradient(90deg, #0e1577, #3a8dff);
            color: #fff;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            footer {
                flex-direction: row;
                justify-content: space-between;
                height: 70px;
                padding: 0 1px;
                background-color: rgba(0,0,0,0.0)
            }

            .footer-link i {
                font-size: 20px;
            }

            .footer-link a {
                padding: 8px 10px;
                font-size: 14px;
            }

            .balance-container {
                top: 10px;
                right: 10px;
                font-size: 14px;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>

<!-- Solde total en haut à droite -->
<div class="balance-container" >
    Solde total : <span id="solde">{{ number_format(auth()->user()->balance ?? 0, 3, ',', ' ') }} FCFA</span>
</div>
<main>
    @yield('content')
</main>

<footer>
    <div class="footer-link">
        <i class="fas fa-home"></i>
        <a href="{{ url('/dashboard') }}">Home</a>
    </div>
    <div class="footer-link">
        <i class="fas fa-comments"></i>
        <a href="{{ url('/chat') }}">Chat</a>
    </div>
    <div class="footer-link">
        <i class="fas fa-gift"></i>
        <a href="{{ url('/lucky-loop') }}">Lucky Loop</a>
    </div>
    <div class="footer-link">
        <i class="fas fa-users"></i>
        <a href="{{ url('/equipe') }}">Équipe</a>
    </div>
    <div class="footer-link">
        <i class="fas fa-user"></i>
        <a href="{{ url('/moi') }}">Moi</a>
    </div>
</footer>

</body>
</html>
