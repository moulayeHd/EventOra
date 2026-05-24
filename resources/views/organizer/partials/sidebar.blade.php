@php
    $navigation = [
        ['section' => 'overview', 'label' => 'Dashboard', 'icon' => 'dashboard', 'title' => 'Dashboard', 'subtitle' => 'Vue globale de vos evenements et performances.'],
        ['section' => 'events', 'label' => 'Mes evenements', 'icon' => 'calendar', 'title' => 'Mes evenements', 'subtitle' => $stats['events'].' evenement(s) geres depuis EventOra.'],
        ['section' => 'reservations', 'label' => 'Reservations', 'icon' => 'ticket', 'title' => 'Reservations', 'subtitle' => $stats['reservations'].' reservation(s) recues.'],
        ['section' => 'participants', 'label' => 'Participants', 'icon' => 'users', 'title' => 'Participants', 'subtitle' => $stats['participants'].' participant(s) uniques.'],
        ['section' => 'payments', 'label' => 'Paiements', 'icon' => 'wallet', 'title' => 'Paiements', 'subtitle' => 'Revenus, tiers de prix et suivi financier.'],
        ['section' => 'statistics', 'label' => 'Statistiques', 'icon' => 'chart', 'title' => 'Statistiques', 'subtitle' => 'Analyse des ventes, conversion et tendance.'],
        ['section' => 'settings', 'label' => 'Parametres', 'icon' => 'settings', 'title' => 'Parametres', 'subtitle' => 'Profil, securite et preferences de votre espace.'],
    ];
@endphp

<aside class="organizer-sidebar" aria-label="Navigation organisateur">
    <div class="organizer-sidebar__brand">
        <a class="organizer-brand" href="{{ route('organisateur') }}" aria-label="EventOra organisateur">
            <span class="organizer-brand__mark">
                <img src="{{ asset('logo/logo/logo.png') }}" alt="" aria-hidden="true">
            </span>
            <span>EventOra</span>
        </a>

        <button class="organizer-icon-button organizer-sidebar__close" type="button" data-sidebar-close aria-label="Fermer le menu">
            <x-organizer.icon name="x" />
        </button>
    </div>

    <div class="organizer-sidebar__scroll">
        <p class="organizer-sidebar__label">Workspace</p>

        <nav class="organizer-nav">
            @foreach ($navigation as $item)
                <button
                    class="organizer-nav__item {{ $loop->first ? 'is-active' : '' }}"
                    type="button"
                    data-section-target="{{ $item['section'] }}"
                    data-title="{{ $item['title'] }}"
                    data-subtitle="{{ $item['subtitle'] }}"
                    aria-current="{{ $loop->first ? 'page' : 'false' }}"
                >
                    <x-organizer.icon :name="$item['icon']" />
                    <span>{{ $item['label'] }}</span>
                </button>
            @endforeach
        </nav>

        <div class="organizer-upgrade">
            <div class="organizer-upgrade__icon">
                <x-organizer.icon name="sparkles" />
            </div>
            <strong>Upgrade to Pro</strong>
            <p>Debloquez l'IA, les exports avances et les analyses premium.</p>
            <button type="button">Upgrade</button>
        </div>

        <div class="organizer-sidebar__footer">
            <a href="{{ route('home') }}">
                <x-organizer.icon name="arrow" />
                <span>Voir le site public</span>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <x-organizer.icon name="logout" />
                    <span>Deconnexion</span>
                </button>
            </form>
        </div>
    </div>
</aside>
