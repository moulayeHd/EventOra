<section class="organizer-panel" data-section-panel="events" hidden>
    <div class="organizer-section-toolbar">
        <div class="organizer-filter-group" data-status-filters>
            <button class="is-active" type="button" data-status-filter="all">Tous</button>
            <button type="button" data-status-filter="live">Live</button>
            <button type="button" data-status-filter="upcoming">A venir</button>
            <button type="button" data-status-filter="draft">Brouillons</button>
            <button type="button" data-status-filter="ended">Termines</button>
        </div>

        <div class="organizer-toolbar-actions">
            <label class="organizer-search organizer-search--compact">
                <x-organizer.icon name="search" />
                <input type="search" placeholder="Rechercher un evenement..." data-panel-search>
            </label>
            <button class="organizer-primary-action" type="button" data-open-create>
                <x-organizer.icon name="plus" />
                <span>Nouvel evenement</span>
            </button>
        </div>
    </div>

    <article class="organizer-table-card organizer-reveal">
        <div class="organizer-table organizer-table--events">
            <div class="organizer-table__row organizer-table__row--head">
                <span>Evenement</span>
                <span>Date</span>
                <span>Status</span>
                <span>Vendus</span>
                <span>Revenus</span>
                <span></span>
            </div>

            @forelse ($eventRows as $row)
                <div class="organizer-table__row" data-searchable data-status="{{ $row['status']['key'] }}">
                    <div class="organizer-event-cell">
                        <span class="organizer-list__icon"><x-organizer.icon name="calendar" /></span>
                        <div>
                            <strong>{{ $row['name'] }}</strong>
                            <small>{{ $row['location'] }}</small>
                        </div>
                    </div>
                    <span>{{ $row['date']->format('d M Y') }}</span>
                    <span><em class="organizer-badge organizer-badge--{{ $row['status']['key'] }}">{{ $row['status']['label'] }}</em></span>
                    <div class="organizer-progress">
                        <strong>{{ number_format($row['sold']) }}</strong>
                        <span><i style="width: {{ $row['percentage'] }}%"></i></span>
                        <small>{{ $row['percentage'] }}%</small>
                    </div>
                    <strong>{{ number_format($row['revenue'], 0, ',', ' ') }} FCFA</strong>
                    <div class="organizer-row-actions">
                        <a class="organizer-icon-button" href="{{ route('event.details', $row['model']) }}" aria-label="Voir l'evenement">
                            <x-organizer.icon name="eye" />
                        </a>
                        <form action="{{ route('events.destroy', $row['model']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="source" value="organizer">
                            <button
                                class="organizer-icon-button organizer-danger"
                                type="submit"
                                aria-label="Supprimer"
                                onclick="return confirm('Voulez-vous vraiment supprimer l\'événement « {{ $row['name'] }} » ? Cette action est irréversible.')">
                                <x-organizer.icon name="x" />
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="organizer-empty organizer-empty--table">
                    <strong>Aucun evenement cree</strong>
                    <span>Votre catalogue apparaitra ici apres creation.</span>
                </div>
            @endforelse
        </div>
    </article>
</section>