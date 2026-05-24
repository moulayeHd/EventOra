@php
    $navigation = [
        ['section' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard', 'title' => 'Dashboard', 'subtitle' => 'Vue globale de la plateforme.'],
        ['section' => 'users', 'label' => 'Users', 'icon' => 'users', 'title' => 'Users', 'subtitle' => $stats['users'].' total'],
        ['section' => 'events', 'label' => 'Events', 'icon' => 'calendar', 'title' => 'Events', 'subtitle' => $stats['events'].' total'],
        ['section' => 'settings', 'label' => 'Settings', 'icon' => 'settings', 'title' => 'Settings', 'subtitle' => 'Configuration de demonstration'],
    ];
@endphp

<aside class="admin-sidebar" aria-label="Navigation administrateur">
    <div class="admin-sidebar__brand">
        <a class="admin-brand" href="{{ route('admin.dashboard') }}" aria-label="EventOra admin">
            <span class="admin-brand__mark">
                <x-admin.icon name="shield" />
            </span>
            <span>EventOra Admin</span>
        </a>

        <button class="admin-icon-button admin-sidebar__close" type="button" data-admin-sidebar-close aria-label="Fermer le menu">
            <x-admin.icon name="x" />
        </button>
    </div>

    <div class="admin-sidebar__body">
        <nav class="admin-nav">
            @foreach ($navigation as $item)
                <button
                    class="admin-nav__item {{ $loop->first ? 'is-active' : '' }}"
                    type="button"
                    data-admin-section-target="{{ $item['section'] }}"
                    data-title="{{ $item['title'] }}"
                    data-subtitle="{{ $item['subtitle'] }}"
                    aria-current="{{ $loop->first ? 'page' : 'false' }}"
                >
                    <x-admin.icon :name="$item['icon']" />
                    <span>{{ $item['label'] }}</span>
                </button>
            @endforeach
        </nav>
    </div>

    <div class="admin-sidebar__footer">
        <a href="{{ route('home') }}">
            <x-admin.icon name="arrow" />
            <span>Site public</span>
        </a>
        <span>v1.0 - donnees Laravel</span>
    </div>
</aside>
