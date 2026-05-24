@php
    $adminUser = $admin ?? auth()->user();
    $profileInitials = collect(preg_split('/\s+/', trim($adminUser?->name ?? 'Admin EventOra')))
        ->filter()
        ->take(2)
        ->map(fn ($word) => mb_substr($word, 0, 1))
        ->implode('');
@endphp

<header class="admin-topbar">
    <div class="admin-topbar__title">
        <button class="admin-icon-button admin-topbar__menu" type="button" data-admin-sidebar-toggle aria-label="Ouvrir le menu">
            <x-admin.icon name="menu" />
        </button>

        <div>
            <h1 data-admin-topbar-title>Dashboard</h1>
            <p data-admin-topbar-subtitle>Vue globale de la plateforme.</p>
        </div>
    </div>

    <div class="admin-topbar__actions">
        <button class="admin-icon-button admin-notification" type="button" aria-label="Notifications">
            <x-admin.icon name="bell" />
            <span></span>
        </button>

        <div class="admin-user-menu">
            <button class="admin-profile" type="button" data-admin-profile-toggle aria-expanded="false" aria-label="Menu administrateur">
                <span>{{ $profileInitials ?: 'AD' }}</span>
            </button>

            <div class="admin-user-dropdown" data-admin-profile-menu hidden>
                <strong>{{ $adminUser?->name ?? 'Admin' }}</strong>
                <small>{{ $adminUser?->email ?? 'admin@eventora.app' }}</small>
                <button type="button" data-admin-section-target="settings">
                    <x-admin.icon name="settings" />
                    <span>Parametres</span>
                </button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        <x-admin.icon name="logout" />
                        <span>Deconnexion</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="admin-topbar__identity">
            <strong>{{ $adminUser?->name ?? 'Admin' }}</strong>
            <span>{{ $adminUser?->email ?? 'admin@eventora.app' }}</span>
        </div>
    </div>
</header>
