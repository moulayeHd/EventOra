@extends('layouts.app')

@section('title', 'Événements - EventOra')

@section('content')
    @php
        $events = [
            [
                'tag' => 'Conférence',
                'date' => '14 mars 2026',
                'place' => 'Bamako',
                'title' => 'TechSummit 2026',
                'text' => 'Une journée de conférences, ateliers et rencontres autour des expériences numériques.',
                'image' => 'images/image/IMAGE 1.png',
                'slug' => 'techsummit-2026',
            ],
            [
                'tag' => 'Musique',
                'date' => '21 juin 2026',
                'place' => 'Ségou',
                'title' => 'Solstice Festival',
                'text' => 'Un festival en plein air avec scénographie lumineuse, artistes live et espaces premium.',
                'image' => 'images/image/IMAGE 2.png',
                'slug' => 'solstice-festival',
            ],
            [
                'tag' => 'Gala',
                'date' => '8 septembre 2026',
                'place' => 'Paris',
                'title' => 'Atelier Gala',
                'text' => 'Une soirée élégante pensée pour les marques, les créateurs et les invités VIP.',
                'image' => 'images/image/IMAGE 3.WEBP',
                'slug' => 'atelier-gala',
            ],
            [
                'tag' => 'Networking',
                'date' => '18 octobre 2026',
                'place' => 'Dakar',
                'title' => 'Founders Night',
                'text' => 'Rencontres ciblées, tables rondes et moments de connexion pour bâtisseurs ambitieux.',
                'image' => 'images/image/IMAGE 5.png',
                'slug' => 'founders-night',
            ],
        ];
    @endphp

    <section class="page-hero compact-hero">
        <div class="hero-inner narrow">
            <p class="eyebrow pill"><span></span>Agenda public</p>
            <h1>Découvrez les événements EventOra</h1>
            <p class="hero-copy">Conférences, concerts, galas et rencontres professionnelles sélectionnés pour des expériences fluides, belles et mémorables.</p>
        </div>
    </section>

    <section class="listing-section section-pad">
        <div class="filter-row" aria-label="Catégories d’événements">
            <button class="filter-pill is-active" type="button">Tous</button>
            <button class="filter-pill" type="button">Conférence</button>
            <button class="filter-pill" type="button">Musique</button>
            <button class="filter-pill" type="button">Gala</button>
            <button class="filter-pill" type="button">Networking</button>
        </div>

        <div class="listing-grid">
            @foreach ($events as $event)
                <article class="listing-card">
                    <a class="listing-image" href="{{ route('event.details', $event['slug']) }}">
                        <span class="event-tag">{{ $event['tag'] }}</span>
                        <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}">
                    </a>
                    <div class="listing-body">
                        <p class="event-meta">{{ $event['date'] }} <span>•</span> {{ $event['place'] }}</p>
                        <h2>{{ $event['title'] }}</h2>
                        <p>{{ $event['text'] }}</p>
                        <a class="btn btn-glass" href="{{ route('event.details', $event['slug']) }}">Voir les détails</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
