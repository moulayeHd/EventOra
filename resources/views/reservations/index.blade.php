@extends('layouts.app')

@section('title', 'Mes reservations - EventOra')

@section('content')
    <section class="dashboard-section section-pad">
        <div class="dashboard-header">
            <div>
                <p class="eyebrow">Espace utilisateur</p>
                <h1>Mes reservations</h1>
            </div>
            <a class="btn btn-primary" href="{{ route('events') }}">Reserver un evenement</a>
        </div>

        <div class="dashboard-panel">
            <div class="data-table">
                <div class="table-row table-head">
                    <span>Evenement</span>
                    <span>Billet</span>
                    <span>Quantite</span>
                    <span>Modifier</span>
                    <span>Annuler</span>
                </div>

                @forelse ($reservations as $reservation)
                    <div class="table-row">
                        <span>{{ $reservation->billet?->evenement?->nom ?? 'Evenement supprime' }}</span>
                        <span>{{ $reservation->billet?->type ?? 'Billet' }}</span>
                        <span>{{ $reservation->quantite }}</span>
                        <span>
                            <form action="{{ route('reservations.update', $reservation) }}" method="POST" class="inline-form compact">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantite" min="1" value="{{ $reservation->quantite }}">
                                <button class="btn btn-glass btn-small" type="submit">OK</button>
                            </form>
                        </span>
                        <span>
                            <form action="{{ route('reservations.destroy', $reservation) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-glass btn-small" type="submit">Annuler</button>
                            </form>
                        </span>
                    </div>
                @empty
                    <div class="empty-state">
                        <h2>Aucune reservation</h2>
                        <p>Vos reservations apparaitront ici apres votre premier achat.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
