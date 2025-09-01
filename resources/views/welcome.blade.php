<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CryptoInvest - Investissement rentable</title>
    <link rel="shortcut icon" href="{{ asset('IMAGES/favicon.ico') }}" type="image/x-icon">
    <style>
        /* Reset basique */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #121212; color: #e0e0e0; }

        /* Header */
        header {
            background: #1f1f2e;
            color: #fff;
            padding: 50px 20px;
            text-align: center;
        }
        header h1 { font-size: 3rem; margin-bottom: 15px; color: #ff9800; }
        header p { font-size: 1.2rem; max-width: 700px; margin: 0 auto; color: #ccc; }

        /* Boutons */
        .btn {
            display: inline-block;
            margin: 20px 10px 0;
            padding: 12px 25px;
            background: #3a8dff;
            color: #fff;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn:hover { background: #2865c2; transform: scale(1.05); }

        /* Sections */
        section { padding: 60px 20px; text-align: center; }
        section h2 { font-size: 2rem; margin-bottom: 20px; color: #ff9800; }
        section p { font-size: 1.1rem; max-width: 800px; margin: 0 auto 30px; color: #ccc; }

        /* Grille des fonctionnalités */
        .features { display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-top: 30px; }
        .feature-card {
            background: #1f1f2e;
            padding: 25px;
            border-radius: 12px;
            width: 250px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.7);
        }
        .feature-card h3 { color: #3a8dff; margin-bottom: 12px; }
        .feature-card p { font-size: 1rem; color: #ccc; }

        /* Footer */
        footer {
            background: #1f1f2e;
            color: #ccc;
            text-align: center;
            padding: 25px 20px;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Bienvenue sur CryptoInvest</h1>
        <p>Votre plateforme d’investissement rentable, simple et sécurisée. Déposez, investissez et regardez vos gains croître en toute confiance.</p>
        <a href="{{ route('register') }}" class="btn">Créer un compte</a>
        <a href="{{ route('login') }}" class="btn">Se connecter</a>
    </header>

    <!-- Section : Pourquoi nous choisir -->
    <section>
        <h2>Pourquoi choisir CryptoInvest ?</h2>
        <p>Nous offrons des solutions d’investissement adaptées à tous les profils, avec des rendements compétitifs et une sécurité maximale pour vos fonds.</p>
        <div class="features">
            <div class="feature-card">
                <h3>Investissement sûr</h3>
                <p>Vos fonds sont sécurisés avec des protocoles modernes et fiables.</p>
            </div>
            <div class="feature-card">
                <h3>Rendements attractifs</h3>
                <p>Profitez de taux de retour compétitifs et transparents.</p>
            </div>
            <div class="feature-card">
                <h3>Support client</h3>
                <p>Une équipe dédiée pour répondre à toutes vos questions.</p>
            </div>
        </div>
    </section>

    <!-- Section : Comment ça marche -->
    <section style="background:#1a1a28;">
        <h2>Comment ça marche ?</h2>
        <p>Inscrivez-vous, déposez vos fonds, choisissez vos plans d’investissement et suivez vos gains en temps réel depuis votre tableau de bord.</p>
    </section>

    <!-- Section : Appel à l'action -->
    <section>
        <h2>Prêt à démarrer ?</h2>
        <p>Rejoignez dès maintenant des milliers d’investisseurs qui font fructifier leur capital sur CryptoInvest.</p>
        <a href="{{ route('register') }}" class="btn">Ouvrir un compte</a>
    </section>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} CryptoInvest. Tous droits réservés.
    </footer>

</body>
</html>
