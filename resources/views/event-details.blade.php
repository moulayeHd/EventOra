@extends('layouts.app')

@section('title', $event->nom.' - EventOra')

@section('content')
    @php
        $date = \Illuminate\Support\Carbon::parse($event->date)->format('d/m/Y');
        $debut = substr($event->heure_debut, 0, 5);
        $fin = substr($event->heure_fin, 0, 5);
    @endphp

    <section class="details-hero">
        <img src="{{ $event->imageUrl() }}" alt="{{ $event->nom }}">
        <div class="details-overlay">
            <p class="eyebrow pill"><span></span>{{ $event->espace?->nom ?? 'Evenement' }}</p>
            <h1>{{ $event->nom }}</h1>
            <p>{{ $event->description }}</p>
        </div>
    </section>

    <section class="details-section section-pad">
        <div class="details-content">
            <article class="details-copy">
                <p class="eyebrow">Experience complete</p>
                <h2>Informations de l'evenement</h2>
                <p>{{ $event->description }}</p>

                <div class="ticket-list">
                    <h3>Billets disponibles</h3>

                    @forelse ($event->billets as $billet)
                        <div class="ticket-row">
                            <div>
                                <strong>{{ $billet->type }}</strong>
                                <span>{{ number_format($billet->prix, 0, ',', ' ') }} FCFA - {{ $billet->quantite }} restant(s)</span>
                            </div>

                            @auth
                                <form action="{{ route('reservations.store') }}" method="POST" class="inline-form">
                                    @csrf
                                    <input type="hidden" name="billet_id" value="{{ $billet->id }}">
                                    <input type="number" name="quantite" min="1" max="{{ max($billet->quantite, 1) }}" value="1" {{ $billet->quantite < 1 ? 'disabled' : '' }}>
                                    <button class="btn btn-primary btn-small" type="submit" {{ $billet->quantite < 1 ? 'disabled' : '' }}>
                                        Reserver et acheter
                                    </button>
                                </form>
                            @else
                                <a class="btn btn-glass btn-small" href="{{ route('login') }}">Se connecter</a>
                            @endauth
                        </div>
                    @empty
                        <p>Aucun billet n'est encore disponible pour cet evenement.</p>
                    @endforelse
                </div>
            </article>

            <aside class="details-panel">
                <div>
                    <span>Date</span>
                    <strong>{{ $date }}</strong>
                </div>
                <div>
                    <span>Horaire</span>
                    <strong>{{ $debut }} - {{ $fin }}</strong>
                </div>
                <div>
                    <span>Lieu</span>
                    <strong>{{ $event->espace?->nom ?? 'Lieu a confirmer' }}</strong>
                    <small>{{ $event->espace?->localisation }}</small>
                </div>
                <a class="btn btn-primary" href="{{ route('events') }}">Retour aux evenements</a>
            </aside>
        </div>
    </section>
@endsection
