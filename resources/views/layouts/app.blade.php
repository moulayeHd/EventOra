<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EventOra')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        #loader {
            position: fixed;
            inset: 0;
            background: #050712;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 16px;
            transition: opacity 0.5s ease;
        }

        #loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        #loader img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        #loader h1 {
            font-size: 2rem;
            font-weight: bold;
            background: linear-gradient(135deg, #7758ff, #079cff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 3px;
        }

        .spinner {
            width: 45px;
            height: 45px;
            border: 4px solid rgba(255,255,255,0.1);
            border-top-color: #7758ff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div id="loader">
        <img src="{{ asset('logo/logo/logo.png') }}" alt="EventOra">
        <h1>EventOra</h1>
        <div class="spinner"></div>
    </div>

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
                    @if (auth()->user()->isOrganisateur())
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
                    @if (auth()->user()->isUtilisateur())
                        @php
                            $nonLues = auth()->user()->notificationsNonLues();
                        @endphp
                        <a href="{{ route('notifications.index') }}" style="position:relative; display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:999px; border:1px solid rgba(255,255,255,.14); background:rgba(255,255,255,.05); color:#fff; text-decoration:none;" aria-label="Notifications">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:17px; height:17px;" aria-hidden="true">
                                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 7h18s-3 0-3-7"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg>
                            @if ($nonLues > 0)
                                <span style="position:absolute; top:-2px; right:-2px; background:#EF4444; color:white; font-size:10px; font-weight:700; width:18px; height:18px; border-radius:50%; display:flex; align-items:center; justify-content:center; line-height:1;">
                                    {{ $nonLues > 9 ? '9+' : $nonLues }}
                                </span>
                            @endif
                        </a>
                    @endif

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

    <script>
        const loader = document.getElementById('loader');

        const dejàVisité = sessionStorage.getItem('dejàVisité');

        window.addEventListener('load', function () {
            const delai = dejàVisité ? 0 : 2000;
            sessionStorage.setItem('dejàVisité', 'oui');
            setTimeout(() => {
                loader.classList.add('hidden');
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 500);
            }, delai);
        });

        document.addEventListener('submit', function () {
            loader.style.display = 'flex';
            loader.classList.remove('hidden');
        });
    </script>

    <script>
        (function () {
            const carousel = document.querySelector('[data-carousel]');
            if (!carousel) return;

            const track = carousel.querySelector('[data-track]');
            const slides = track.children;
            const dots = carousel.querySelectorAll('[data-dot-index]');
            const prevBtn = carousel.querySelector('[data-prev]');
            const nextBtn = carousel.querySelector('[data-next]');
            let current = 0;
            let timer;

            function goTo(index) {
                current = (index + slides.length) % slides.length;
                track.style.transform = `translateX(-${current * 100}%)`;
                dots.forEach(dot => dot.classList.remove('is-active'));
                dots[current].classList.add('is-active');
            }

            function next() {
                goTo(current + 1);
            }

            function prev() {
                goTo(current - 1);
            }

            function startAuto() {
                timer = setInterval(next, 4500);
            }

            function stopAuto() {
                clearInterval(timer);
            }

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    goTo(parseInt(dot.dataset.dotIndex, 10));
                    stopAuto();
                    startAuto();
                });
            });

            nextBtn?.addEventListener('click', () => {
                next();
                stopAuto();
                startAuto();
            });

            prevBtn?.addEventListener('click', () => {
                prev();
                stopAuto();
                startAuto();
            });

            carousel.addEventListener('mouseenter', stopAuto);
            carousel.addEventListener('mouseleave', startAuto);

            startAuto();
        })();
    </script>

    <script>
        (function () {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });

            document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
        })();
    </script>

    <script>
    (function () {
        function animateCounter(el) {
            const target = el.innerText.trim();
            let endValue = parseFloat(target.replace(/[^0-9.]/g, ''));
            const suffix = target.replace(/[0-9.]/g, '');
            const duration = 2000;
            const steps = 60;
            const stepTime = duration / steps;
            let current = 0;
            const increment = endValue / steps;

            const timer = setInterval(() => {
                current += increment;
                if (current >= endValue) {
                    current = endValue;
                    clearInterval(timer);
                }
                el.innerText = (Number.isInteger(endValue)
                    ? Math.floor(current)
                    : current.toFixed(1)) + suffix;
            }, stepTime);
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.querySelectorAll('strong').forEach(animateCounter);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        const statsPanel = document.querySelector('.stats-panel');
        if (statsPanel) observer.observe(statsPanel);
    })();
</script>
</body>
</html>