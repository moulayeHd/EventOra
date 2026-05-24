<section class="organizer-panel" data-section-panel="participants" hidden>
    <div class="organizer-section-toolbar">
        <div>
            <p class="organizer-kicker">Audience</p>
            <h2>Participants</h2>
        </div>

        <div class="organizer-toolbar-actions">
            <label class="organizer-search organizer-search--compact">
                <x-organizer.icon name="search" />
                <input type="search" placeholder="Rechercher participant..." data-panel-search>
            </label>
            <button class="organizer-secondary-action" type="button">
                <x-organizer.icon name="mail" />
                <span>Email</span>
            </button>
            <button class="organizer-primary-action" type="button">
                <x-organizer.icon name="download" />
                <span>Export CSV</span>
            </button>
        </div>
    </div>

    <article class="organizer-table-card organizer-reveal">
        <div class="organizer-table organizer-table--participants">
            <div class="organizer-table__row organizer-table__row--head">
                <span>Participant</span>
                <span>Evenement</span>
                <span>Type</span>
                <span>Billets</span>
                <span>Inscrit</span>
            </div>

            @forelse ($participants as $participant)
                <div class="organizer-table__row" data-searchable>
                    <div class="organizer-avatar-cell">
                        <span>{{ $participant['initials'] }}</span>
                        <div>
                            <strong>{{ $participant['name'] }}</strong>
                            <small>{{ $participant['email'] }}</small>
                        </div>
                    </div>
                    <span>{{ $participant['event'] }}</span>
                    <span><em class="organizer-badge organizer-badge--live">{{ $participant['tier'] }}</em></span>
                    <strong>{{ $participant['quantity'] }}</strong>
                    <span>{{ $participant['registered_at']?->diffForHumans() ?? '-' }}</span>
                </div>
            @empty
                <div class="organizer-empty organizer-empty--table">
                    <strong>Aucun participant</strong>
                    <span>Les participants seront listes des la premiere reservation.</span>
                </div>
            @endforelse
        </div>
    </article>
</section>
