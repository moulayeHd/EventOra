@extends('layouts.app')

@section('title', 'Verification billet - EventOra')

@section('content')
    <section class="dashboard-section section-pad">
        <div class="dashboard-header">
            <div>
                <p class="eyebrow">Verification</p>
                <h1>Billet valide</h1>
            </div>
            <a class="btn btn-primary" href="{{ route('events') }}">Voir les evenements</a>
        </div>

        <article class="ticket-verify-card">
            <div>
                <span>Code billet</span>
                <strong>{{ $reservation->ticket_code }}</strong>
            </div>

            <div>
                <span>Evenement</span>
                <strong>{{ $reservation->billet?->evenement?->nom ?? 'Evenement' }}</strong>
            </div>

            <div>
                <span>Participant</span>
                <strong>{{ $reservation->user?->name ?? 'Participant' }}</strong>
                <small>{{ $reservation->user?->email }}</small>
            </div>

            <div>
                <span>Quantite</span>
                <strong>{{ $reservation->quantite }}</strong>
            </div>

            <div>
                <span>Lieu</span>
                <strong>{{ $reservation->billet?->evenement?->espace?->nom ?? 'Lieu a confirmer' }}</strong>
                <small>{{ $reservation->billet?->evenement?->espace?->localisation }}</small>
            </div>
        </article>
    </section>
@endsection
