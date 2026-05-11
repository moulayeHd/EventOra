<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact - EventOra</title>
    <link rel="stylesheet" href="globals.css" />
    <link rel="stylesheet" href="Index.css" />
    <link rel="stylesheet" href="contact.css">
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <div class="logo-box">
                <img src="../logo/logo.png" alt="EventOra Logo" />
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
            <button class="btn-primary">S’inscrire</button>
        </div>
    </header>

    <main class="contact-page">
        <div class="contact-container">
            <div class="contact-content">
                <div class="contact-text">
                    <h1>Discutons <span>ensemble</span></h1>
                    <p>Parlez-nous de votre événement. Que vous soyez en phase de planification ou prêt à lancer, notre équipe est là pour vous accompagner.</p>
                    
                    <div class="contact-details">
                        <div class="detail-item">
                            <strong>Email :</strong>
                            <span>contact@eventora.com</span>
                        </div>
                        <div class="detail-item">
                            <strong>Support :</strong>
                            <span>Disponible 24/7</span>
                        </div>
                    </div>
                </div>

                <div class="contact-glass-form">
                    <form action="#">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Prénom</label>
                                <input type="text" placeholder="Jean">
                            </div>
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" placeholder="Dupont">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" placeholder="jean@exemple.fr">
                        </div>

                        <div class="form-group">
                            <label>Votre message</label>
                            <textarea placeholder="Dites-nous en plus sur votre projet..."></textarea>
                        </div>

                        <button type="submit" class="btn-primary w-full">Envoyer le message</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

   <footer class="main-footer">
            <div class="footer-container">
                <div class="footer-brand">
                    <div class="logo">
                        <div class="logo-icon"></div>
                        <img src="../logo/logo.png" alt="EventOra Logo" />
                        <!--<span>EventOra</span>-->
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