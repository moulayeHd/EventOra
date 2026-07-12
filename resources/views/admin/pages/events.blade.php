<section class="admin-panel" data-admin-section-panel="events" hidden>
    <div class="admin-section-toolbar">
        <label class="admin-search">
            <x-admin.icon name="search" />
            <input type="search" placeholder="Search events..." data-admin-panel-search>
        </label>

        <a class="admin-primary-action" href="{{ route('organisateur') }}#events">
            <x-admin.icon name="plus" />
            <span>Add event</span>
        </a>
    </div>

    <article class="admin-table-card">
        <div class="admin-table admin-table--events">
            <div class="admin-table__row admin-table__row--head">
                <span>Event</span>
                <span>Date</span>
                <span>Location</span>
                <span>Actions</span>
            </div>

            @forelse ($eventRows as $event)
                <div class="admin-table__row" data-admin-searchable>
                    <div class="admin-event-cell">
                        <span class="admin-list__icon"><x-admin.icon name="calendar" /></span>
                        <div>
                            <strong>{{ $event['name'] }}</strong>
                            <small>{{ $event['organizer'] }}</small>
                        </div>
                    </div>
                    <span>{{ $event['date']->format('Y-m-d') }}</span>
                    <span>{{ $event['location'] }}</span>
                    <div class="admin-row-actions">
                        <a class="admin-icon-button" href="{{ route('event.details', $event['model']) }}" aria-label="Voir {{ $event['name'] }}">
                           <x-organizer.icon name="eye" />
                        </a>
                        <form action="{{ route('events.destroy', $event['model']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="source" value="admin">
                            <button class="admin-icon-button" type="submit" aria-label="Supprimer {{ $event['name'] }}">
                                <x-admin.icon name="trash" />
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="admin-empty admin-empty--table">
                    <strong>Aucun evenement</strong>
                    <span>Les evenements crees apparaitront ici.</span>
                </div>
            @endforelse
        </div>
    </article>
</section>
