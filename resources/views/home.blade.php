<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>EventOra</title>

        <link rel="stylesheet" href="{{ asset('css/globals.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/Index.css') }}" />
     
    </head>

    <body>
        <!-- NAVBAR -->
        <header class="navbar">
            <div class="logo">
                <div class="logo-box">
                   <img src="{{ asset('logo/Logo eventora.png') }}" alt="EventOra Logo" />
                </div>
            <!-- <span>EventOra</span> -->
            </div>

            <nav class="nav-links">
                <a href="index.html">Accueil</a>
                <a href="evenement.html">Événements</a>
                <a href="contact.html">Contact</a>
            </nav>

            <div class="nav-actions">
                <button class="btn-secondary">Se connecter</button>
                <a href="Inscription.html" class="btn-primary">S’inscrire</a>
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
            <h2>Boîte à outils complète sur l'événement</h2>
            <p class="features-subtitle">
                Tout ce dont vous avez besoin pour gérer des événements culturels de classe mondiale,
                de la création à l'analyse en temps réel.
            </p>

            <div class="feature-grid">
                <div class="card">
                    <div class="icon blue">
                        <img src="{{ asset('icone/creation d'evenement.png') }}" alt="Création d'Événements" />
                    </div>
                    <h3>Création d'Événements</h3>
                    <p>Créez des événements en quelques minutes avec notre éditeur intuitif.</p>
                </div>

                <div class="card">
                    <div class="icon green">
                        <img src="{{ asset('icone/billetterie et inscription.jpg') }}" alt="Billetterie & Inscription" />
                    </div>
                    <h3>Billetterie & Inscription</h3>
                    <p>Gérez VIP, paiements sécurisés et suivi en temps réel.</p>
                </div>

                <div class="card">
                    <div class="icon cyan">
                        <img src="{{ asset('icone/participation.png') }}" alt="Gestion des Participants" />
                    </div>
                    <h3>Gestion des Participants</h3>
                    <p>Suivez les inscriptions et gérez les listes facilement.</p>
                </div>

                <div class="card">
                    <div class="icon yellow">
                        <img src="{{ asset('icone/analytique.png') }}" alt="Analytics & Rapports" />
                    </div>
                    <h3>Analytics & Rapports</h3>
                    <p>Analysez vos performances et optimisez vos événements.</p>
                </div>

                <div class="card">
                    <div class="icon purple">
                        <img src="{{ asset('icone/promotion.png') }}" alt="Promotion & Partage" />
                    </div>
                    <h3>Promotion & Partage</h3>
                    <p>Diffusez vos événements et augmentez votre visibilité.</p>
                </div>

                <div class="card">
                    <div class="icon red">
                        <img src="{{ asset('icone/gestion des lieux.png') }}" alt="Gestion des Lieux" />
                    </div>
                    <h3>Gestion des Lieux</h3>
                    <p>Gérez salles, capacités et disponibilités.</p>
                </div>
            </div>
        </section>

        <!-- EVENTS -->
        <section class="events">
            <h2>Evénements vedets</h2>

            <div class="event-grid">
                <!-- CARD 1 -->
                <div class="event-card">
                    <span class="event-tag">Conference</span>
                    <img src="{{ asset('image/IMAGE 1.png') }}" alt="event" />
                    <div class="event-overlay">
                        <p>12 Mars • Bamako</p>
                        <h3>Conference administrative</h3>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="event-card">
                    <span class="event-tag">Musique</span>
                    <img src="{{ asset('image/IMAGE 2.png') }}" alt="event" />
                    <div class="event-overlay">
                        <p>21 Juin • Segou</p>
                        <h3> Festival sur le Niger</h3>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="event-card">
                    <span class="event-tag">Gala</span>
                    <img src="{{ asset('image/IMAGE 3.WEBP') }}" alt="event" />
                    <div class="event-overlay">
                        <p>18 Octobre • Bamako</p>
                        <h3>KoKo Fashion</h3>
                    </div>
                </div>
            </div>
        </section>
        <!-- end events -->

        <!-- TESTIMONIALS -->
        <section class="testimonials">
            <p class="testimonials-top">Aimé par les équipes</p>
            <h2>Validé par des experts de l'organisation d'événements</h2>

            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <p class="quote">
                        "Lumen a fait passer notre sommet annuel du chaos à la chorégraphie. Notre équipe a finalement dormi la nuit précédente."
                    </p>
                    <div class="user-info">
                        <div class="avatar-circle sasha">SR</div>
                        <div>
                            <h4>Sasha Renault</h4>
                            <p>Responsable des événements, North Star</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="quote">
                        "Le flux d'enregistrementà lui seul nous a permis d'économiser 40 heures de personnel. Les participants l'ont apprecié."
                    </p>
                    <div class="user-info">
                        <div class="avatar-circle marco">MV</div>
                        <div>
                            <h4>Marco Vela</h4>
                            <p>Producteur, Atlas Festivals</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="quote">
                        "Nous avons remplacé quatre outils par un seul. Le vernis est irréel."
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
                <h2>Votre prochain événement mérite <span>EventOra</span></h2>
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
                         <img src="{{ asset('logo/logo.png') }}" alt="EventOra Logo" />
                        <!--<span>EventSphere</span>-->
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
                <p>© 2026 EventOra Events. Tous droits réservés.</p>
                <div class="social-icons">
                    <span class="social-circle">T</span>
                    <span class="social-circle">G</span>
                    <span class="social-circle">L</span>
                </div>
            </div>
        </footer>
    </body>
</html>