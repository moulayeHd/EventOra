@extends('layouts.app')

@section('title', 'Verification billet - EventOra')

@section('content')
    <section class="dashboard-section section-pad">
        <div class="dashboard-header">
            <div>
                <p class="eyebrow">Verification</p>
                <h1>
                    @if ($dejaUtilise)
                        ⚠️ Billet déjà utilisé
                    @else
                        ✅ Billet valide
                    @endif
                </h1>
            </div>
            <a class="btn btn-primary" href="{{ route('events') }}">Voir les evenements</a>
        </div>

        @if ($dejaUtilise)
            <div class="site-flash site-flash--error" style="margin-bottom: 24px;">
                Ce billet a déjà été scanné le {{ \Carbon\Carbon::parse($reservation->utilise_le)->format('d/m/Y à H:i') }}. Il ne peut pas être utilisé une deuxième fois.
            </div>
        @else
            <div class="site-flash site-flash--success" style="margin-bottom: 24px;">
                Billet validé avec succès ! Accès autorisé.
            </div>
        @endif

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

            @if ($dejaUtilise)
                <div>
                    <span>Scanné le</span>
                    <strong>{{ \Carbon\Carbon::parse($reservation->utilise_le)->format('d/m/Y à H:i') }}</strong>
                </div>
            @endif
        </article>
    </section>
@endsection