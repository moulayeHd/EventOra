<section class="admin-panel is-active" data-admin-section-panel="dashboard">
    <div class="admin-stats-grid">
        <article class="admin-stat-card">
            <div class="admin-stat-card__icon"><x-admin.icon name="users" /></div>
            <span class="admin-stat-card__trend">+{{ $stats['organisateurs'] }}</span>
            <strong>{{ number_format($stats['users']) }}</strong>
            <p>Total users</p>
        </article>

        <article class="admin-stat-card">
            <div class="admin-stat-card__icon"><x-admin.icon name="calendar" /></div>
            <span class="admin-stat-card__trend">+{{ $stats['reservations'] }}</span>
            <strong>{{ number_format($stats['events']) }}</strong>
            <p>Total events</p>
        </article>

        <article class="admin-stat-card">
            <div class="admin-stat-card__icon"><x-admin.icon name="ticket" /></div>
            <span class="admin-stat-card__trend">+{{ number_format($stats['billets']) }}</span>
            <strong>{{ number_format($stats['tickets_sold']) }}</strong>
            <p>Tickets sold</p>
        </article>

        <article class="admin-stat-card">
            <div class="admin-stat-card__icon"><x-admin.icon name="trend" /></div>
            <span class="admin-stat-card__trend">+{{ $stats['administrateurs'] }}</span>
            <strong>{{ number_format($stats['revenue'], 0, ',', ' ') }} FCFA</strong>
            <p>Revenue total</p>
        </article>
    </div>

    <div class="admin-dashboard-grid">
        <article class="admin-card">
            <div class="admin-card__head">
                <h2>Recent users</h2>
            </div>

            <div class="admin-list">
                @forelse ($recentUsers as $user)
                    @php
                        $initials = collect(preg_split('/\s+/', trim($user->name ?: 'User')))
                            ->filter()
                            ->take(2)
                            ->map(fn ($word) => mb_substr($word, 0, 1))
                            ->implode('');
                    @endphp
                    <div class="admin-list__item" data-admin-searchable>
                        <span class="admin-avatar">{{ $initials }}</span>
                        <div>
                            <strong>{{ $user->name }}</strong>
                            <small>{{ $user->email }}</small>
                        </div>
                        <em>{{ ucfirst($user->role) }}</em>
                    </div>
                @empty
                    <div class="admin-empty">
                        <strong>Aucun utilisateur</strong>
                        <span>Les comptes crees apparaitront ici.</span>
                    </div>
                @endforelse
            </div>
        </article>

        <article class="admin-card">
            <div class="admin-card__head">
                <h2>Upcoming events</h2>
            </div>

            <div class="admin-list">
                @forelse ($upcomingEvents as $event)
                    <div class="admin-list__item admin-list__item--event" data-admin-searchable>
                        <span class="admin-list__icon"><x-admin.icon name="calendar" /></span>
                        <div>
                            <strong>{{ $event['name'] }}</strong>
                            <small>{{ $event['location'] }}</small>
                        </div>
                        <em>{{ $event['date']->format('Y-m-d') }}</em>
                    </div>
                @empty
                    <div class="admin-empty">
                        <strong>Aucun evenement</strong>
                        <span>Les prochains evenements apparaitront ici.</span>
                    </div>
                @endforelse
            </div>
        </article>
    </div>
</section>
