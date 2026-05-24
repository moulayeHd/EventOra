<section class="organizer-panel" data-section-panel="payments" hidden>
    <div class="organizer-section-toolbar">
        <div>
            <p class="organizer-kicker">Finance</p>
            <h2>Paiements</h2>
        </div>

        <button class="organizer-secondary-action" type="button">
            <x-organizer.icon name="download" />
            <span>Rapport financier</span>
        </button>
    </div>

    <div class="organizer-stats-grid organizer-stats-grid--three">
        <x-organizer.stat-card icon="wallet" label="Revenus encaisses" :value="number_format($stats['revenue'], 0, ',', ' ').' FCFA'" trend="+ premium" tone="emerald" />
        <x-organizer.stat-card icon="card" label="Panier moyen" :value="number_format($stats['average_order'], 0, ',', ' ').' FCFA'" trend="Par reservation" tone="violet" />
        <x-organizer.stat-card icon="ticket" label="Tiers actifs" :value="number_format($ticketTiers->count())" trend="Billetterie" tone="cyan" />
    </div>

    <div class="organizer-ticket-grid">
        @forelse ($ticketTiers as $tier)
            <article class="organizer-ticket-card organizer-reveal" data-searchable>
                <div class="organizer-ticket-card__head">
                    <span class="organizer-icon organizer-icon--cyan"><x-organizer.icon name="ticket" /></span>
                    <div>
                        <h3>{{ $tier['type'] }}</h3>
                        <p>{{ $tier['event'] }}</p>
                    </div>
                    <strong>{{ $tier['price'] > 0 ? number_format($tier['price'], 0, ',', ' ').' FCFA' : 'Gratuit' }}</strong>
                </div>

                <div class="organizer-ticket-card__meta">
                    <span>{{ number_format($tier['sold']) }} vendus</span>
                    <strong>{{ $tier['percentage'] }}%</strong>
                </div>
                <div class="organizer-progress organizer-progress--full">
                    <span><i style="width: {{ $tier['percentage'] }}%"></i></span>
                    <small>Capacite {{ number_format($tier['capacity']) }}</small>
                </div>
            </article>
        @empty
            <article class="organizer-empty organizer-empty--panel">
                <strong>Aucun tier de billet</strong>
                <span>Ajoutez des billets a vos evenements pour suivre les paiements.</span>
            </article>
        @endforelse
    </div>

    <article class="organizer-table-card organizer-reveal">
        <div class="organizer-card__head organizer-card__head--inside">
            <div>
                <h2>Revenus par evenement</h2>
                <p>Vue consolidee des ventes et recettes</p>
            </div>
        </div>

        <div class="organizer-table organizer-table--payments">
            <div class="organizer-table__row organizer-table__row--head">
                <span>Evenement</span>
                <span>Vendus</span>
                <span>Occupation</span>
                <span>Revenus</span>
                <span>Status</span>
            </div>

            @forelse ($eventRows as $row)
                <div class="organizer-table__row" data-searchable>
                    <strong>{{ $row['name'] }}</strong>
                    <span>{{ number_format($row['sold']) }}</span>
                    <div class="organizer-progress">
                        <span><i style="width: {{ $row['percentage'] }}%"></i></span>
                        <small>{{ $row['percentage'] }}%</small>
                    </div>
                    <strong>{{ number_format($row['revenue'], 0, ',', ' ') }} FCFA</strong>
                    <span><em class="organizer-badge organizer-badge--{{ $row['status']['key'] }}">{{ $row['status']['label'] }}</em></span>
                </div>
            @empty
                <div class="organizer-empty organizer-empty--table">
                    <strong>Aucune donnee de paiement</strong>
                    <span>Les revenus seront calcules automatiquement.</span>
                </div>
            @endforelse
        </div>
    </article>
</section>
