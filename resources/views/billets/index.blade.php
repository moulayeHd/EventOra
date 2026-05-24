@extends('layouts.app')

@section('title', 'Mes billets - EventOra')

@section('content')
    <section class="dashboard-section section-pad">
        <div class="dashboard-header">
            <div>
                <p class="eyebrow">Billetterie</p>
                <h1>Mes billets</h1>
            </div>
            <a class="btn btn-primary" href="{{ route('reservations.index') }}">Mes reservations</a>
        </div>

        <div class="ticket-grid">
            @forelse ($billets as $reservation)
                <article class="ticket-card">
                    <div>
                        <span>{{ $reservation->billet?->type ?? 'Billet' }}</span>
                        <h2>{{ $reservation->billet?->evenement?->nom ?? 'Evenement' }}</h2>
                        <p>Quantite : {{ $reservation->quantite }}</p>
                        <p>Code : <strong>{{ $reservation->ticket_code }}</strong></p>
                        <a class="text-link" href="{{ $reservation->verification_url }}">Verifier le billet</a>
                    </div>
                    <img src="{{ $reservation->qr_code }}" alt="QR code billet">
                </article>
            @empty
                <article class="empty-state">
                    <h2>Aucun billet</h2>
                    <p>Vos billets avec QR code seront generes apres reservation.</p>
                </article>
            @endforelse
        </div>
    </section>
@endsection
