<section class="admin-panel" data-admin-section-panel="users" hidden>
    <div class="admin-section-toolbar">
        <label class="admin-search">
            <x-admin.icon name="search" />
            <input type="search" placeholder="Search users..." data-admin-panel-search>
        </label>
    </div>

    <article class="admin-management-card">
        <div class="admin-card__head">
            <div>
                <h2>Add user</h2>
                <p>Creer un compte utilisateur, organisateur ou administrateur.</p>
            </div>
        </div>

        <form class="admin-inline-form" action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nom complet" required>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="email@eventora.test" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <select name="role" required>
                <option value="utilisateur" @selected(old('role') === 'utilisateur')>Utilisateur</option>
                <option value="organisateur" @selected(old('role') === 'organisateur')>Organisateur</option>
                <option value="administrateur" @selected(old('role') === 'administrateur')>Administrateur</option>
            </select>
            <button class="admin-primary-action" type="submit">
                <x-admin.icon name="plus" />
                <span>Add user</span>
            </button>
        </form>
    </article>

    <article class="admin-table-card">
        <div class="admin-table admin-table--users">
            <div class="admin-table__row admin-table__row--head">
                <span>Name</span>
                <span>Email</span>
                <span>Role</span>
                <span>Actions</span>
            </div>

            @forelse ($users as $user)
                @php
                    $initials = collect(preg_split('/\s+/', trim($user->name ?: 'User')))
                        ->filter()
                        ->take(2)
                        ->map(fn ($word) => mb_substr($word, 0, 1))
                        ->implode('');
                @endphp
                <div class="admin-table__row" data-admin-searchable>
                    <div class="admin-user-cell">
                        <span class="admin-avatar">{{ $initials }}</span>
                        <strong>{{ $user->name }}</strong>
                    </div>
                    <span>{{ $user->email }}</span>
                    <span><em class="admin-role admin-role--{{ $user->role }}">{{ ucfirst($user->role) }}</em></span>
                    <div class="admin-row-actions">
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="admin-icon-button" type="submit" aria-label="Supprimer {{ $user->name }}">
                                <x-admin.icon name="trash" />
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="admin-empty admin-empty--table">
                    <strong>Aucun utilisateur</strong>
                    <span>Les comptes crees apparaitront ici.</span>
                </div>
            @endforelse
        </div>
    </article>
</section>
