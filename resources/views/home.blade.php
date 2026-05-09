<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>EventSphere</title>

        <link rel="stylesheet" href="{{ asset('css/globals.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
     
    </head>

    <body>
        <!-- NAVBAR -->
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

        <!-- HERO -->
        <section class="hero">
            <h1>Organisez vos événements <span>facilement</span></h1>
            <p>Une plateforme moderne pour créer, gérer et promouvoir vos événements.</p>

            <div class="hero-buttons">
                <button class="btn-primary">Commencer</button>
                <button class="btn-outline">Voir les événements</button>
            </div>
        </section>

        <!-- FEATURES -->
        <section class="features">
            <h2>L'Event Toolkit Complet</h2>
            <p class="features-subtitle">
                Tout ce dont vous avez besoin pour gérer des événements culturels de classe mondiale,
                de la création à l'analyse en temps réel.
            </p>

            <div class="feature-grid">
                <div class="card">
                    <div class="icon blue"></div>
                    <h3>Création d'Événements</h3>
                    <p>Créez des événements en quelques minutes avec notre éditeur intuitif.</p>
                </div>

                <div class="card">
                    <div class="icon green"></div>
                    <h3>Billetterie & Inscription</h3>
                    <p>Gérez VIP, paiements sécurisés et suivi en temps réel.</p>
                </div>

                <div class="card">
                    <div class="icon cyan"></div>
                    <h3>Gestion des Participants</h3>
                    <p>Suivez les inscriptions et gérez les listes facilement.</p>
                </div>

                <div class="card">
                    <div class="icon yellow"></div>
                    <h3>Analytics & Rapports</h3>
                    <p>Analysez vos performances et optimisez vos événements.</p>
                </div>

                <div class="card">
                    <div class="icon purple"></div>
                    <h3>Promotion & Partage</h3>
                    <p>Diffusez vos événements et augmentez votre visibilité.</p>
                </div>

                <div class="card">
                    <div class="icon red"></div>
                    <h3>Gestion des Lieux</h3>
                    <p>Gérez salles, capacités et disponibilités.</p>
                </div>
            </div>
        </section>

        <!-- EVENTS -->
        <section class="events">
            <h2>Featured events</h2>

            <div class="event-grid">
                <!-- CARD 1 -->
                <div class="event-card">
                    <span class="event-tag">Conference</span>
                    <img src="concert.jpg" alt="event" />
                    <div class="event-overlay">
                        <p>Mar 14 • San Francisco</p>
                        <h3>TechSummit 2026</h3>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="event-card">
                    <span class="event-tag">Music</span>
                    <img src="show.jpg" alt="event" />
                    <div class="event-overlay">
                        <p>Jun 21 • Lisbon</p>
                        <h3>Solstice Festival</h3>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="event-card">
                    <span class="event-tag">Gala</span>
                    <img src="festi.jpg" alt="event" />
                    <div class="event-overlay">
                        <p>Sep 08 • Paris</p>
                        <h3>Atelier Gala</h3>
                    </div>
                </div>
            </div>
        </section>
        <!-- end events -->

        <!-- TESTIMONIALS -->
        <section class="testimonials">
            <p class="testimonials-top">Loved by teams</p>
            <h2>Trusted by world-class organizers</h2>

            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <p class="quote">
                        "Lumen took our annual summit from chaos to choreography. Our team finally sleeps the night before."
                    </p>
                    <div class="user-info">
                        <div class="avatar-circle sasha">SR</div>
                        <div>
                            <h4>Sasha Renault</h4>
                            <p>Head of Events, Northstar</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="quote">
                        "The check-in flow alone saved us 40 staff-hours. Attendees noticed."
                    </p>
                    <div class="user-info">
                        <div class="avatar-circle marco">MV</div>
                        <div>
                            <h4>Marco Vela</h4>
                            <p>Producer, Atlas Festivals</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="quote">
                        "We replaced four tools with one. The polish is unreal."
                    </p>
                    <div class="user-info">
                        <div class="avatar-circle priya">PA</div>
                        <div>
                            <h4>Priya Anand</h4>
                            <p>COO, Vertex Studios</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end testimonials -->

        <section class="cta-section">
            <div class="cta-card">
                <h2>Votre prochain événement mérite <span>EventSphere</span></h2>
                <p>Commencez gratuitement. Passez à l'offre supérieure quand vous serez prêt. Aucune carte de crédit requise.</p>
                <button class="btn-cta">Commencer à organiser votre événement</button>
            </div>
        </section>

        <!-- FOOTER -->
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