@extends('layouts.app')

@section('title', 'EventOra - Plateforme moderne pour événements')

@section('content')
    @php
        $features = [
            [
                'title' => 'Création d’événements',
                'text' => 'Lancez de superbes pages événementielles en quelques minutes avec des outils intuitifs.',
                'icon' => 'icones/icone/creation d\'evenement.png',
                'symbol' => '✦',
            ],
            [
                'title' => 'Billetterie & inscription',
                'text' => 'Vendez des billets, gérez les RSVP et suivez les paiements sans friction.',
                'icon' => 'icones/icone/billetterie et inscription.jpg',
                'symbol' => '◇',
            ],
            [
                'title' => 'Gestion des participants',
                'text' => 'Suivez les arrivées, segmentez vos audiences et personnalisez chaque interaction.',
                'icon' => 'icones/icone/participation.png',
                'symbol' => '◎',
            ],
            [
                'title' => 'Reporting & analytics',
                'text' => 'Des tableaux de bord en temps réel révèlent ce qui fonctionne et quoi optimiser ensuite.',
                'icon' => 'icones/icone/analytique.png',
                'symbol' => '△',
            ],
            [
                'title' => 'Gestion des lieux',
                'text' => 'Coordonnez les espaces, les plans et les capacités sur plusieurs sites.',
                'icon' => 'icones/icone/gestion des lieux.png',
                'symbol' => '□',
            ],
            [
                'title' => 'Promotion intelligente',
                'text' => 'Partagez vos événements, activez vos communautés et mesurez chaque canal.',
                'icon' => 'icones/icone/promotion.png',
                'symbol' => '×',
            ],
        ];

        $events = [
            [
                'tag' => 'Conférence',
                'date' => '14 mars',
                'place' => 'Bamako',
                'title' => 'TechSummit 2026',
                'image' => 'images/image/IMAGE 1.png',
                'slug' => 'techsummit-2026',
            ],
            [
                'tag' => 'Musique',
                'date' => '21 juin',
                'place' => 'Ségou',
                'title' => 'Solstice Festival',
                'image' => 'images/image/IMAGE 2.png',
                'slug' => 'solstice-festival',
            ],
            [
                'tag' => 'Gala',
                'date' => '8 septembre',
                'place' => 'Paris',
                'title' => 'Atelier Gala',
                'image' => 'images/image/IMAGE 3.WEBP',
                'slug' => 'atelier-gala',
            ],
        ];

        $testimonials = [
            [
                'quote' => 'EventOra a transformé notre sommet annuel : moins de chaos, plus de précision. Notre équipe dort enfin la veille.',
                'initials' => 'SR',
                'name' => 'Sasha Renault',
                'role' => 'Responsable événements, Northstar',
            ],
            [
                'quote' => 'Le parcours d’accueil nous a économisé quarante heures d’équipe. Les participants l’ont remarqué immédiatement.',
                'initials' => 'MV',
                'name' => 'Marco Vela',
                'role' => 'Producteur, Atlas Festivals',
            ],
            [
                'quote' => 'Nous avons remplacé quatre outils par un seul. Le niveau de finition est impressionnant.',
                'initials' => 'PA',
                'name' => 'Priya Anand',
                'role' => 'COO, Vertex Studios',
            ],
        ];
    @endphp

    <section class="hero-section">
        <div class="hero-inner">
            <p class="eyebrow pill"><span></span>Nouveau - Aperçus participants propulsés par l’IA</p>
            <h1>Transformer les événements, <span>gérés sans effort.</span></h1>
            <p class="hero-copy">La plateforme de bout en bout pour les organisateurs qui soignent chaque détail. Créez, vendez et pilotez des événements qui paraissent inévitables.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('events') }}">Commencer à organiser</a>
                <a class="btn btn-glass" href="{{ route('events') }}">Explorer les événements →</a>
            </div>
            <div class="stats-panel" aria-label="Statistiques EventOra">
                <div class="stats">
                    <h1 class="counter" data-target="428">0</h1>
                    <span>événements hébergés</span>
                </div>
                <div class="stats">
                    <h1 class="counter" data-target="13200">0</h1>
                    <span>billets vendus</span>
                </div>
                <div class="stats">
                    <h1 class="counter" data-target="75">0</h1>
                    <span>NPS moyen</span>
                </div>
            </div>
        </div>
    </section>

    <section class="toolkit-section section-pad" id="features">
        <div class="section-heading centered">
            <p class="eyebrow">Boîte à outils événementielle</p>
            <h2>Tout ce dont vous avez besoin.<span> Rien de superflu.</span></h2>
        </div>

        <div class="feature-grid">
            @foreach ($features as $feature)
                <article class="feature-card">
                    <div class="feature-icon">
                        <img src="{{ asset($feature['icon']) }}" alt="">
                        <span>{{ $feature['symbol'] }}</span>
                    </div>
                    <h3>{{ $feature['title'] }}</h3>
                    <p>{{ $feature['text'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="events-section section-pad">
        <div class="section-heading split">
            <div>
                <p class="eyebrow">À venir</p>
                <h2>Événements à la une</h2>
            </div>
            <a class="text-link" href="{{ route('events') }}">Tout voir →</a>
        </div>

        <div class="event-card-grid">
            @foreach ($events as $event)
                <a class="event-card" href="{{ route('event.details', $event['slug']) }}">
                    <span class="event-tag">{{ $event['tag'] }}</span>
                    <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}">
                    <div class="event-card-body">
                        <p>{{ $event['date'] }} <span>•</span> {{ $event['place'] }}</p>
                        <h3>{{ $event['title'] }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="testimonials-section section-pad" id="testimonials">
        <div class="section-heading centered">
            <p class="eyebrow">Aimé par les équipes</p>
            <h2>Adopté par des organisateurs de classe mondiale</h2>
        </div>

        <div class="testimonial-grid">
            @foreach ($testimonials as $testimonial)
                <article class="testimonial-card">
                    <p>“{{ $testimonial['quote'] }}”</p>
                    <div class="testimonial-author">
                        <span>{{ $testimonial['initials'] }}</span>
                        <div>
                            <strong>{{ $testimonial['name'] }}</strong>
                            <small>{{ $testimonial['role'] }}</small>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="cta-section section-pad" id="cta">
        <div class="cta-card">
            <h2>Votre prochain événement mérite <span>EventOra.</span></h2>
            <p>Commencez gratuitement. Passez à l’offre supérieure quand vous êtes prêt. Aucune carte bancaire requise.</p>
            <a class="btn btn-primary" href="{{ route('events') }}">Commencer à organiser votre événement</a>
        </div>
    </section>
@endsection
