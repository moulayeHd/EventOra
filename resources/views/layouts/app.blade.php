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
                @auth
                    <a href="{{ route('reservations.index') }}" class="{{ request()->routeIs('reservations.*') || request()->routeIs('billets.index') ? 'is-active' : '' }}">Mes reservations</a>
                    @if (auth()->user()->isOrganisateur() || auth()->user()->isAdmin())
                        <a href="{{ route('organisateur') }}" class="{{ request()->routeIs('organisateur') ? 'is-active' : '' }}">Organisateur</a>
                    @endif
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">Admin</a>
                    @endif
                @endauth
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'is-active' : '' }}">Contact</a>
            </nav>

            <div class="header-actions">
                @auth
                    {{-- Cloche notifications --}}
                    @php
                        $nonLues = auth()->user()->notificationsNonLues();
                    @endphp
                    <a href="{{ route('notifications.index') }}" style="position:relative; display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:50%; background:var(--color-background-secondary, #1a1a2e); color:var(--color-text-primary, #fff); text-decoration:none;" aria-label="Notifications">
                        🔔
                        @if ($nonLues > 0)
                            <span style="position:absolute; top:-2px; right:-2px; background:#EF4444; color:white; font-size:10px; font-weight:700; width:18px; height:18px; border-radius:50%; display:flex; align-items:center; justify-content:center; line-height:1;">
                                {{ $nonLues > 9 ? '9+' : $nonLues }}
                            </span>
                        @endif
                    </a>

                    <span class="signin-link">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-glass btn-small" type="submit">Sortir</button>
                    </form>
                @else
                    <a class="signin-link" href="{{ route('login') }}">Se connecter</a>
                    <a class="btn btn-primary btn-small" href="{{ route('inscription') }}">Commencer</a>
                @endauth
            </div>
        </header>

        <main>
            @if (session('success'))
                <div class="site-flash site-flash--success" role="status">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="site-flash site-flash--error" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

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
</body>
</html>