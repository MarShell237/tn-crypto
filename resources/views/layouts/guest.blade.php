<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* --------- BASE --------- */
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* ✅ empêche le scroll vertical */
            font-family: 'Figtree', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background 0.6s, color 0.6s;
        }

        body {
            background: linear-gradient(135deg, #3a8dff, #4f46e5, #00c6ff);
            background-size: 200% 200%;
            animation: gradientShift 10s ease infinite;
            color: #222;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* --------- DARK MODE AUTOMATIQUE --------- */
        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #0f172a, #1e293b, #334155);
                color: #f1f5f9;
            }

            .card {
                background: rgba(30, 41, 59, 0.8);
                box-shadow: 0 8px 40px rgba(0, 0, 0, 0.4);
            }

            .logo img {
                filter: brightness(0.9);
            }
        }

        /* --------- CONTAINER PRINCIPAL --------- */
        .main-container {
            width: 100%;
            height: 100%;
            max-width: 100vw;
            max-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 20px;
        }

        /* --------- LOGO --------- */
        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            width: 85px;
            height: auto;
            filter: drop-shadow(0 3px 6px rgba(0, 0, 0, 0.3));
            transition: transform 0.3s ease, filter 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.08);
            filter: brightness(1.1);
        }

        /* --------- CARD FORMULAIRE --------- */
        .card {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(14px);
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --------- RESPONSIVE --------- */
        @media (max-width: 480px) {
            .card {
                padding: 28px 20px;
                border-radius: 14px;
            }
            .logo img {
                width: 70px;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="card">
            @yield('content')
        </div>
    </div>
</body>
</html>
