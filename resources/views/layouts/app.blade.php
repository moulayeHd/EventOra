<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EventOra')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="site-shell">
        <header class="site-header">
            <a class="brand" href="{{ route('home') }}" aria-label="EventOra - accueil">
                <span class="brand-mark">
                    <img src="{{ asset('logo/logo/logo.png') }}" alt="" aria-hidden="true">
                </span>
                <span>EventOra</span>
            </a>

            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation">
                <span></span>
                <span></span>
            </button>

            <nav class="primary-nav" id="primary-navigation" aria-label="Navigation principale">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">Accueil</a>
                <a href="{{ route('events') }}" class="{{ request()->routeIs('events') || request()->routeIs('event.details') ? 'is-active' : '' }}">Événements</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'is-active' : '' }}">À propos</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'is-active' : '' }}">Contact</a>
            </nav>

            <div class="header-actions">
                <a class="signin-link" href="{{ route('contact') }}">Se connecter</a>
                <a class="btn btn-primary btn-small" href="{{ route('events') }}">Commencer</a>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="site-footer">
            <div class="footer-main">
                <div class="footer-brand">
                    <a class="brand" href="{{ route('home') }}" aria-label="EventOra - accueil">
                        <span class="brand-mark">
                            <img src="{{ asset('logo/logo/logo.png') }}" alt="" aria-hidden="true">
                        </span>
                        <span>EventOra</span>
                    </a>
                    <p>Transformer les événements, les gérer sans friction. La plateforme moderne pour les organisateurs exigeants.</p>
                </div>

                <div class="footer-links">
                    <div>
                        <h3>Produit</h3>
                        <a href="{{ route('home') }}#features">Fonctionnalités</a>
                        <a href="{{ route('events') }}">Événements</a>
                        <a href="{{ route('home') }}#cta">Démarrer</a>
                    </div>
                    <div>
                        <h3>Entreprise</h3>
                        <a href="{{ route('contact') }}">Contact</a>
                        <a href="{{ route('about') }}">À propos</a>
                        <a href="{{ route('home') }}#testimonials">Clients</a>
                    </div>
                    <div>
                        <h3>Légal</h3>
                        <a href="#">Confidentialité</a>
                        <a href="#">Conditions</a>
                        <a href="#">Sécurité</a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2026 EventOra Events. Tous droits réservés.</p>
                <div class="social-links" aria-label="Réseaux sociaux">
                    <a href="#" aria-label="Twitter">T</a>
                    <a href="#" aria-label="GitHub">G</a>
                    <a href="#" aria-label="LinkedIn">L</a>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/counte.js') }}"></script>

</body>
</html>
