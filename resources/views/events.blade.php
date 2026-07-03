@extends('layouts.app')

@section('title', 'Evenements - EventOra')

@section('content')
    @php
        $eventImages = [
            'images/image/IMAGE 1.png',
            'images/image/IMAGE 2.png',
            'images/image/IMAGE 3.WEBP',
            'images/image/IMAGE 5.png',
        ];
    @endphp

    <section class="page-hero compact-hero hero-slider">
        <div class="hero-slides">
                     <div class="hero-slide" style="background-image: url('{{ asset('images/image/IMAGE 1.png') }}');"></div>
                     <div class="hero-slide" style="background-image: url('{{ asset('images/image/IMAGE 2.png') }}');"></div>
                     <div class="hero-slide" style="background-image: url('{{ asset('images/image/IMAGE 3.WEBP') }}');"></div>
                     <div class="hero-slide" style="background-image: url('{{ asset('images/image/IMAGE 5.png') }}');"></div>
        </div>
        <div class="hero-inner narrow">
            <p class="eyebrow pill"><span></span>Agenda public</p>
            <h1>Decouvrez les evenements EventOra</h1>
            <p class="hero-copy">Conférences, concerts, galas et rencontres professionnelles sont maintenant charges depuis la base de donnees.</p>
        </div>
    </section>

    <section class="listing-section section-pad">
        <div class="filter-row" aria-label="Categories d'evenements">
            <button class="filter-pill is-active" type="button" data-filter="tous">Tous</button>
            <button class="filter-pill" type="button" data-filter="avenir">À venir</button>
            <button class="filter-pill" type="button" data-filter="passes">Passés</button>
        </div>

        <div class="listing-grid">
            @forelse ($events as $event)
                <article class="listing-card" data-date="{{ $event->date }}">
                    <a class="listing-image" href="{{ route('event.details', $event) }}">
                        <span class="event-tag">{{ $event->espace?->nom ?? 'Evenement' }}</span>
                        <img src="{{ $event->imageUrl($eventImages[$loop->index % count($eventImages)]) }}" alt="{{ $event->nom }}">
                    </a>
                    <div class="listing-body">
                        <p class="event-meta">
                            {{ \Illuminate\Support\Carbon::parse($event->date)->format('d/m/Y') }}
                            <span>-</span>
                            {{ $event->espace?->localisation ?? 'Lieu a confirmer' }}
                        </p>
                        <h2>{{ $event->nom }}</h2>
                        <p>{{ \Illuminate\Support\Str::limit($event->description, 150) }}</p>
                        <a class="btn btn-glass" href="{{ route('event.details', $event) }}">Voir les details</a>
                    </div>
                </article>
            @empty
                <article class="empty-state">
                    <h2>Aucun evenement disponible</h2>
                    <p>Les evenements crees par les organisateurs apparaitront ici automatiquement.</p>
                </article>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $events->links() }}
        </div>
    </section>
@endsection