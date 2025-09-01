<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'InvestPro') }}</title>

    <style>
        /* Global */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #fff;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 30px;
            background-color: #1e1e1e;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }

        .navbar .logo {
            font-weight: bold;
            font-size: 22px;
            color: #3a8dff;
        }

        .navbar ul.nav-links {
            display: flex;
            gap: 25px;
        }

        .navbar ul.nav-links li {
            padding: 8px 12px;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .navbar ul.nav-links li:hover {
            background-color: #333;
        }

        /* Hamburger menu */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 4px;
        }

        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: #fff;
        }

        /* Main content */
        main {
            padding: 20px 30px;
            min-height: calc(100vh - 120px);
        }

        /* Footer */
        footer {
            display: flex;
            justify-content: space-around;
            background-color: #1e1e1e;
            padding: 20px 0;
            color: #aaa;
            flex-wrap: wrap;
        }

        footer a {
            color: #3a8dff;
            padding: 10px 20px;
            margin: 5px 0;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        footer a:hover {
            background-color: #333;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar ul.nav-links {
                position: fixed;
                top: 60px;
                left: -100%;
                flex-direction: column;
                background-color: #1e1e1e;
                width: 100%;
                height: calc(100% - 60px);
                padding-top: 20px;
                transition: left 0.3s ease-in-out;
            }

            .navbar ul.nav-links.active {
                left: 0;
            }

            .hamburger {
                display: flex;
            }

            .navbar ul.nav-links li {
                text-align: center;
                padding: 15px 0;
            }

            main {
                padding: 15px 20px;
            }

            footer {
                flex-direction: row;
                justify-content: space-around;
                text-align: center;
                flex-wrap: nowrap;
            }

            footer a {
                margin: 0;
                padding: 10px 5px;
            }
        }

    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const hamburger = document.querySelector(".hamburger");
            const navLinks = document.querySelector(".nav-links");
            hamburger.addEventListener("click", () => {
                navLinks.classList.toggle("active");
            });
        });
    </script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">{{ config('app.name', 'InvestPro') }}</div>
        <ul class="nav-links">
            <li><a href="{{ url('/profile') }}">Profil</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:#3a8dff;cursor:pointer;">Déconnexion</button>
                </form>
            </li>
        </ul>
        <div class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ url('/lucky-loop') }}">Lucky Loop</a>
        <a href="{{ url('/equipe') }}">Équipe</a>
    </footer>
</body>
</html>
