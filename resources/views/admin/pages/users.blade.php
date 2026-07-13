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
            <div style="position:relative; display:inline-block;">
                <input type="password" name="password" id="admin-password-field" placeholder="Mot de passe" required style="padding-right:40px;">
                <button type="button" onclick="toggleAdminPassword()" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); background:transparent; border:none; cursor:pointer; padding:0; color:rgba(226,232,255,0.6); display:flex;">
                    <svg id="admin-eye-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
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

<script>
    function toggleAdminPassword() {
        const field = document.getElementById('admin-password-field');
        const icon = document.getElementById('admin-eye-icon');
        if (field.type === 'password') {
            field.type = 'text';
            icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
        } else {
            field.type = 'password';
            icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
        }
    }
</script>