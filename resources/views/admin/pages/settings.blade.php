<section class="admin-panel" data-admin-section-panel="settings" hidden>
    @php
        $settingsAdmin = $admin ?? auth()->user();
    @endphp

    <div class="admin-settings-stack">
        <article class="admin-settings-card">
            <div class="admin-card__head">
                <div>
                    <h2>Workspace</h2>
                    <p>Parametres statiques pour l'interface admin.</p>
                </div>
            </div>

            <div class="admin-form-grid">
                <label>
                    Workspace name
                    <input type="text" value="EventOra Admin" readonly>
                </label>

                <label>
                    Admin email
                    <input type="email" value="{{ $settingsAdmin?->email ?? 'admin@eventora.app' }}" readonly>
                </label>
            </div>
        </article>

        <article class="admin-settings-card">
            <div class="admin-card__head">
                <div>
                    <h2>Demo data</h2>
                    <p>Les donnees sont lues depuis Laravel et votre base MySQL.</p>
                </div>
            </div>

            <button class="admin-secondary-action" type="button" data-admin-toast="Les donnees viennent de la base, aucun reset local n'est necessaire.">
                Reset demo data
            </button>
        </article>

        <article class="admin-settings-card">
            <div class="admin-card__head">
                <div>
                    <h2>Lieux</h2>
                    <p>Ajoutez les lieux qui seront disponibles dans la creation d'evenements organisateur.</p>
                </div>
            </div>

            <form class="admin-inline-form admin-inline-form--venues" action="{{ route('admin.espaces.store') }}" method="POST">
                @csrf
                <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Nom du lieu" required>
                <input type="text" name="localisation" value="{{ old('localisation') }}" placeholder="Ville / adresse" required>
                <input type="number" name="capacite" min="1" value="{{ old('capacite') }}" placeholder="Capacite" required>
                <button class="admin-primary-action" type="submit">
                    <x-admin.icon name="plus" />
                    <span>Ajouter</span>
                </button>
            </form>

            <div class="admin-venue-list">
                @forelse ($espaces as $espace)
                    <div class="admin-venue-item" data-admin-searchable>
                        <div>
                            <strong>{{ $espace->nom }}</strong>
                            <small>{{ $espace->localisation }} - {{ number_format($espace->capacite) }} places</small>
                        </div>
                        <span>{{ $espace->evenements_count }} event(s)</span>
                        <form action="{{ route('admin.espaces.destroy', $espace) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="admin-icon-button" type="submit" aria-label="Supprimer {{ $espace->nom }}">
                                <x-admin.icon name="trash" />
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="admin-empty">
                        <strong>Aucun lieu</strong>
                        <span>Ajoutez un premier lieu pour alimenter le formulaire organisateur.</span>
                    </div>
                @endforelse
            </div>
        </article>
    </div>
</section>
