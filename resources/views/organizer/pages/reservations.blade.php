<section class="organizer-panel" data-section-panel="reservations" hidden>
    <div class="organizer-section-toolbar">
        <div>
            <p class="organizer-kicker">Suivi commercial</p>
            <h2>Reservations recues</h2>
        </div>

        <div class="organizer-toolbar-actions">
            <label class="organizer-search organizer-search--compact">
                <x-organizer.icon name="search" />
                <input type="search" placeholder="Rechercher reservation..." data-panel-search>
            </label>
            <button class="organizer-secondary-action" type="button">
                <x-organizer.icon name="download" />
                <span>Exporter</span>
            </button>
        </div>
    </div>

    <div class="organizer-stats-grid organizer-stats-grid--three">
        <x-organizer.stat-card icon="ticket" label="Reservations" :value="number_format($stats['reservations'])" :trend="$stats['tickets_sold'].' billets'" tone="violet" />
        <x-organizer.stat-card icon="wallet" label="Panier moyen" :value="number_format($stats['average_order'], 0, ',', ' ').' FCFA'" trend="Moyenne" tone="cyan" />
        <x-organizer.stat-card icon="users" label="Participants uniques" :value="number_format($stats['participants'])" trend="CRM" tone="emerald" />
    </div>

    <article class="organizer-table-card organizer-reveal">
        <div class="organizer-table organizer-table--reservations">
            <div class="organizer-table__row organizer-table__row--head">
                <span>Participant</span>
                <span>Evenement</span>
                <span>Type</span>
                <span>Quantite</span>
                <span>Total</span>
                <span>Date</span>
            </div>

            @forelse ($reservations as $reservation)
                <div class="organizer-table__row" data-searchable>
                    <div class="organizer-avatar-cell">
                        <span>{{ collect(preg_split('/\s+/', trim($reservation->user?->name ?? 'EO')))->filter()->take(2)->map(fn ($word) => mb_substr($word, 0, 1))->implode('') }}</span>
                        <div>
                            <strong>{{ $reservation->user?->name ?? 'Participant' }}</strong>
                            <small>{{ $reservation->user?->email ?? 'email@eventora.local' }}</small>
                        </div>
                    </div>
                    <span>{{ $reservation->billet?->evenement?->nom ?? 'Evenement' }}</span>
                    <span><em class="organizer-badge organizer-badge--upcoming">{{ $reservation->billet?->type ?? 'Standard' }}</em></span>
                    <strong>{{ $reservation->quantite }}</strong>
                    <strong>{{ number_format($reservation->quantite * (float) ($reservation->billet?->prix ?? 0), 0, ',', ' ') }} FCFA</strong>
                    <span>{{ $reservation->created_at?->diffForHumans() ?? '-' }}</span>
                </div>
            @empty
                <div class="organizer-empty organizer-empty--table">
                    <strong>Aucune reservation</strong>
                    <span>Les reservations apparaitront dans cette table.</span>
                </div>
            @endforelse
        </div>
    </article>
</section>
