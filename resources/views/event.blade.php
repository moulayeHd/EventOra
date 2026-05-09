<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Discover Events - EventSphere</title>
    <link rel="stylesheet" href="{{ asset('css/globals.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/event.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <div class="logo-box"></div>
            <span>EventSphere</span>
        </div>
        <nav class="nav-links">
            <a href="{{ route('home') }}">Accueil</a>
            <a href="{{ route('event') }}">Événements</a>
            <a href="{{ route('contact') }}">Contact</a>
        </nav>
        <div class="nav-actions">
            <button class="btn-secondary">Se connecter</button>
            <button class="btn-primary">S’inscrire</button>
        </div>
    </header>

    <main class="discover-section">
        <div class="discover-container">
            <h1>Discover events</h1>
            <p class="discover-subtitle">
                Conferences, concerts, galas, and gatherings — handpicked from organizers worldwide.
            </p>

            <div class="search-filter-row">
                <div class="search-input-wrapper">
                    <input type="text" placeholder="Search events, cities, or organizers...">
                </div>
                
                <div class="filter-pills">
                    <button class="pill active">All</button>
                    <button class="pill">Conference</button>
                    <button class="pill">Music</button>
                    <button class="pill">Gala</button>
                    <button class="pill">Networking</button>
                </div>
            </div>

            <div class="event-grid">
                <div class="event-card">
                    <span class="event-tag">Conference</span>
                    <img src="concert.jpg" alt="event" />
                    <div class="event-overlay">
                        <p>Mar 14 • San Francisco</p>
                        <h3>TechSummit 2026</h3>
                    </div>
                </div>

                <div class="event-card">
                    <span class="event-tag">Music</span>
                    <img src="show.jpg" alt="event" />
                    <div class="event-overlay">
                        <p>Jun 21 • Lisbon</p>
                        <h3>Solstice Festival</h3>
                    </div>
                </div>

                <div class="event-card">
                    <span class="event-tag">Gala</span>
                    <img src="festi.jpg" alt="event" />
                    <div class="event-overlay">
                        <p>Sep 08 • Paris</p>
                        <h3>Atelier Gala</h3>
                    </div>
                </div>
                
                </div>
        </div>
    </main>

    <footer class="main-footer">
            <div class="footer-container">
                <div class="footer-brand">
                    <div class="logo">
                        <div class="logo-icon"></div>
                        <span>EventSphere</span>
                    </div>
                    <p>Transformer les événements, une gestion sans faille. La plateforme moderne pour les organisateurs d'événements.</p>
                </div>

                <div class="footer-links">
                    <div class="link-group">
                        <h4>Produit</h4>
                        <ul>
                            <li><a href="#">Fonctionnalités</a></li>
                            <li><a href="#">Tarifs</a></li>
                            <li><a href="#">Événements</a></li>
                        </ul>
                    </div>

                    <div class="link-group">
                        <h4>Entreprise</h4>
                        <ul>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">À propos</a></li>
                            <li><a href="#">Carrières</a></li>
                        </ul>
                    </div>

                    <div class="link-group">
                        <h4>Légal</h4>
                        <ul>
                            <li><a href="#">Confidentialité</a></li>
                            <li><a href="#">Conditions</a></li>
                            <li><a href="#">Sécurité</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2026 EventSphere Events. Tous droits réservés.</p>
                <div class="social-icons">
                    <span class="social-circle">T</span>
                    <span class="social-circle">G</span>
                    <span class="social-circle">L</span>
                </div>
            </div>
        </footer>

</body>
</html>