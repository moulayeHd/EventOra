@extends('layouts.app')

@section('title', 'Détails de l’événement - EventOra')

@section('content')
    @php
        $eventData = [
            'techsummit-2026' => [
                'tag' => 'Conférence',
                'date' => '14 mars 2026',
                'time' => '09:00 - 18:30',
                'place' => 'Palais de la Culture, Bamako',
                'title' => 'TechSummit 2026',
                'description' => 'TechSummit 2026 réunit les décideurs, créateurs et équipes produit autour des nouvelles expériences numériques. Attendez-vous à des conférences rythmées, des ateliers pratiques et des rencontres soigneusement orchestrées.',
                'image' => 'images/image/IMAGE 1.png',
            ],
            'solstice-festival' => [
                'tag' => 'Musique',
                'date' => '21 juin 2026',
                'time' => '17:00 - 01:00',
                'place' => 'Berges du Niger, Ségou',
                'title' => 'Solstice Festival',
                'description' => 'Une soirée musicale immersive portée par une scénographie lumineuse, des artistes live et des espaces d’accueil fluides pour profiter de chaque moment sans attente inutile.',
                'image' => 'images/image/IMAGE 2.png',
            ],
            'atelier-gala' => [
                'tag' => 'Gala',
                'date' => '8 septembre 2026',
                'time' => '19:30 - 23:30',
                'place' => 'Maison des Arts, Paris',
                'title' => 'Atelier Gala',
                'description' => 'Atelier Gala rassemble créateurs, maisons et invités VIP pour une soirée élégante où l’accueil, la billetterie et les temps forts sont pensés dans le moindre détail.',
                'image' => 'images/image/IMAGE 3.WEBP',
            ],
            'founders-night' => [
                'tag' => 'Networking',
                'date' => '18 octobre 2026',
                'time' => '18:00 - 22:00',
                'place' => 'Impact Hub, Dakar',
                'title' => 'Founders Night',
                'description' => 'Une rencontre premium pour fondateurs, investisseurs et équipes en croissance. Tables rondes, introductions ciblées et moments informels dans une ambiance soignée.',
                'image' => 'images/image/IMAGE 5.png',
            ],
        ];

        $event = $eventData[$slug ?? 'techsummit-2026'] ?? $eventData['techsummit-2026'];
    @endphp

    <section class="details-hero">
        <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}">
        <div class="details-overlay">
            <p class="eyebrow pill"><span></span>{{ $event['tag'] }}</p>
            <h1>{{ $event['title'] }}</h1>
            <p>{{ $event['description'] }}</p>
        </div>
    </section>

    <section class="details-section section-pad">
        <div class="details-content">
            <article class="details-copy">
                <p class="eyebrow">Expérience complète</p>
                <h2>Un événement pensé pour être fluide du premier clic à la dernière minute.</h2>
                <p>{{ $event['description'] }}</p>
                <p>EventOra centralise l’inscription, les informations pratiques et l’accueil des participants afin que l’équipe organisatrice reste concentrée sur la qualité de l’expérience.</p>
            </article>

            <aside class="details-panel">
                <div>
                    <span>Date</span>
                    <strong>{{ $event['date'] }}</strong>
                </div>
                <div>
                    <span>Horaire</span>
                    <strong>{{ $event['time'] }}</strong>
                </div>
                <div>
                    <span>Lieu</span>
                    <strong>{{ $event['place'] }}</strong>
                </div>
                <a class="btn btn-primary" href="{{ route('inscription') }}">S’inscrire maintenant</a>
            </aside>
        </div>
    </section>
@endsection
