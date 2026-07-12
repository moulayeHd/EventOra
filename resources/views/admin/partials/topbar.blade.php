@php
    $adminUser = $admin ?? auth()->user();
    $profileInitials = collect(preg_split('/\s+/', trim($adminUser?->name ?? 'Admin EventOra')))
        ->filter()
        ->take(2)
        ->map(fn ($word) => mb_substr($word, 0, 1))
        ->implode('');
    $demandesEnAttente = \App\Models\DemandeOrganisateur::enAttente()->with('user')->latest()->get();
    $dernierIdDemande = $demandesEnAttente->first()?->id ?? 0;
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
        <div class="admin-user-menu">
            <button class="admin-icon-button admin-notification" type="button" data-admin-notif-toggle data-latest-demande-id="{{ $dernierIdDemande }}" aria-label="Notifications" style="position:relative;">
                <x-admin.icon name="bell" />
                @if ($demandesEnAttente->count() > 0)
                    <span data-notif-badge style="position:absolute; top:-2px; right:-2px; background:#EF4444; color:white; font-size:10px; font-weight:700; width:18px; height:18px; border-radius:50%; display:flex; align-items:center; justify-content:center; line-height:1;">
                        {{ $demandesEnAttente->count() > 9 ? '9+' : $demandesEnAttente->count() }}
                    </span>
                @endif
            </button>

            <div class="admin-user-dropdown" data-admin-notif-menu hidden style="min-width:320px; max-height:400px; overflow-y:auto;">
                <strong style="display:block; margin-bottom:8px;">Notifications</strong>
                @forelse ($demandesEnAttente as $demande)
                    <a href="#" data-admin-section-target="demandes" style="display:block; padding:10px 0; border-top:1px solid var(--color-border-secondary); text-decoration:none; color:inherit;">
                        <small style="display:block; color:var(--color-text-secondary); font-size:12px;">
                            ⏳ <strong>{{ $demande->user->name }}</strong> vous a envoyé sa demande pour devenir organisateur ({{ $demande->nom_groupe }})
                        </small>
                        <small style="color:var(--color-text-tertiary); font-size:11px;">{{ $demande->created_at->diffForHumans() }}</small>
                    </a>
                @empty
                    <small style="color:var(--color-text-secondary);">Aucune nouvelle notification.</small>
                @endforelse
            </div>
        </div>

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