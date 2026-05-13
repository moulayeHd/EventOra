<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Discover Events - EventOra</title>
    <link rel="stylesheet" href="{{ asset('css/globals.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/evenement.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/Index.css') }}" />
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <div class="logo-box">
                 <img src="{{ asset('logo/logo.png') }}" alt="EventOra Logo" />
            </div>
           <!-- <span>EventOra</span> -->
        </div>
        <nav class="nav-links">
            <a href="{{ route('home') }}">Accueil</a>
            <a href="{{ route('events') }}">Événements</a>
            <a href="{{ route('contact') }}">Contact</a>
        </nav>
        <div class="nav-actions">
            <button class="btn-secondary">Se connecter</button>
            <button class="btn-primary">S’inscrire</button>
        </div>
    </header>

    <main class="discover-section">
        <div class="discover-container">
            <h1>Découvrez les événements</h1>
            <p class="discover-subtitle">
                Conferences, concerts, galas, et rassemblements— triés sur le volet parmi les organisateurs du monde entier.
            </p>

            <div class="search-filter-row">
                <div class="search-input-wrapper">
                    <input type="text" placeholder="Rechercher des événements, des villes ou des organisateurs...">
                </div>
                
                <!--<div class="filter-pills">
                    <button class="pill active">Tout</button>
                    <button class="pill">Conference</button>
                    <button class="pill">Musique</button>
                    <button class="pill">Gala</button>
                    <button class="pill">Constitution de Réseaux</button>
                </div>-->
                <div class="buttons">
    <button class="pill active" onclick="filterEvents('all')">Tous</button>
    <button class="pill active" onclick="filterEvents('conference')">Conférence</button>
    <button class="pill active" onclick="filterEvents('musique')">Musique</button>
    <button class="pill active" onclick="filterEvents('gala')">Gala</button>
  </div>

            </div>
             <script>
    function filterEvents(category){

      let events = document.querySelectorAll('.event-card');

      events.forEach(function(event){

        if(category === 'all'){
          event.style.display = 'block';
        }
        else if(event.classList.contains(category)){
          event.style.display = 'block';
        }
        else{
          event.style.display = 'none';
        }

      });

    }
  </script>
  <!--<script>
  function filterEvents(category){

  let events = document.querySelectorAll('.event-card');
  let container = document.querySelector('.events');

  // si "all"
  if(category === 'all'){
    container.classList.add('hide-img'); // cache les images
  } else {
    container.classList.remove('hide-img'); // affiche les images
  }

  events.forEach(event => {

    if(category === 'all'){
      event.style.display = 'block';
    }
    else if(event.classList.contains(category)){
      event.style.display = 'block';
    }
    else{
      event.style.display = 'none';
    }

  });
  }</script>-->

            <div class="event-grid">
                <div class="event-card">
                    <span class="event-tag">Conference</span>
                    <img src="{{ asset('image/IMAGE 1.png') }}" alt="event" />
                    <div class="event-overlay">
                         <p>12 Mars • Bamako</p>
                        <h3>Conference administrative</h3>
                    </div>
                </div>

                <div class="event-card">
                    <span class="event-tag">Musique</span>
                    <img  src="{{ asset('image/IMAGE 2.png') }}" alt="event" />
                    <div class="event-overlay">
                        <p>21 Juin • Segou</p>
                        <h3> Festival sur le Niger</h3>
                    </div>
                </div>

                <div class="event-card">
                    <span class="event-tag">Gala</span>
                    <img src="{{ asset('image/IMAGE 3.WEBP') }}" alt="event" />
                    <div class="event-overlay">
                  <p>18 Octobre • Bamako</p>
                        <h3>KoKo Fashion</h3>
                    </div>
                </div>
                
                </div>
        </div>
    </main>
   <!---<div class="event-card conference">
  <img src="../image/IMAGE 1.png" alt="Conférence" />
  <h3>Conférence Tech</h3>
  <p>Discussion sur l’intelligence artificielle.</p>
</div>

<div class="event-card musique">
  <img src="../image/IMAGE 2.png" alt="Musique" />
  <h3>Concert Live</h3>
  <p>Grande soirée musicale.</p>
</div>

<div class="event-card gala">
  <img src="../image/IMAGE 3.WEBP" alt="Gala" />
  <h3>Gala de fin d'année</h3>
  <p>Célébration de la réussite de l'année.</p>
</div>-->

    <footer class="main-footer">
            <div class="footer-container">
                <div class="footer-brand">
                    <div class="logo">
                        <div class="logo-icon">
                             <img src="{{ asset('logo/logo.png') }}" alt="EventOra Logo" />
                        </div>
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