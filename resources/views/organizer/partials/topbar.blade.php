@php
    $profileInitials = collect(preg_split('/\s+/', trim($user->name ?? 'Event Ora')))
        ->filter()
        ->take(2)
        ->map(fn ($word) => mb_substr($word, 0, 1))
        ->implode('');
@endphp

<header class="organizer-topbar">
    <div class="organizer-topbar__title">
        <button class="organizer-icon-button organizer-topbar__menu" type="button" data-sidebar-toggle aria-label="Ouvrir le menu">
            <x-organizer.icon name="menu" />
        </button>

        <div>
            <h1 data-topbar-title>Dashboard</h1>
            <p data-topbar-subtitle>Vue globale de vos evenements et performances.</p>
        </div>
    </div>

    <label class="organizer-search" aria-label="Recherche globale">
        <x-organizer.icon name="search" />
        <input type="search" placeholder="Rechercher evenements, participants..." data-global-search>
    </label>

    <div class="organizer-topbar__actions">
        <span class="organizer-quick-info">
            {{ $stats['live_events'] }} live
        </span>

        <button class="organizer-primary-action" type="button" data-open-create>
            <x-organizer.icon name="plus" />
            <span>Nouvel evenement</span>
        </button>

        <button class="organizer-icon-button organizer-notification" type="button" aria-label="Notifications">
            <x-organizer.icon name="bell" />
            <span></span>
        </button>

        <div class="organizer-user-menu">
            <button class="organizer-profile" type="button" data-profile-toggle aria-expanded="false" aria-label="Menu utilisateur">
                <span>{{ $profileInitials }}</span>
            </button>

            <div class="organizer-user-dropdown" data-profile-menu hidden>
                <strong>{{ $user->name }}</strong>
                <small>{{ $user->email }}</small>
                <button type="button" data-section-target="settings">
                    <x-organizer.icon name="settings" />
                    <span>Parametres</span>
                </button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        <x-organizer.icon name="logout" />
                        <span>Deconnexion</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
