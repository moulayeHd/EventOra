<section class="admin-panel" data-admin-section-panel="demandes" hidden>

    @if (session('success'))
        <div class="admin-alert admin-alert--success" style="margin-bottom:16px; padding:12px 16px; background:#E1F5EE; border-left:3px solid #1D9E75; border-radius:8px; color:#085041; font-size:14px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Stats rapides --}}
    <div style="display:flex; gap:12px; margin-bottom:24px; flex-wrap:wrap;">
        <div style="padding:16px 20px; background:var(--color-background-secondary); border-radius:10px; flex:1; min-width:140px;">
            <p style="font-size:12px; color:var(--color-text-secondary); margin:0 0 4px;">En attente</p>
            <strong style="font-size:24px; color:#F59E0B;">{{ $demandes->where('statut', 'en_attente')->count() }}</strong>
        </div>
        <div style="padding:16px 20px; background:var(--color-background-secondary); border-radius:10px; flex:1; min-width:140px;">
            <p style="font-size:12px; color:var(--color-text-secondary); margin:0 0 4px;">Approuvées</p>
            <strong style="font-size:24px; color:#1D9E75;">{{ $demandes->where('statut', 'approuve')->count() }}</strong>
        </div>
        <div style="padding:16px 20px; background:var(--color-background-secondary); border-radius:10px; flex:1; min-width:140px;">
            <p style="font-size:12px; color:var(--color-text-secondary); margin:0 0 4px;">Refusées</p>
            <strong style="font-size:24px; color:#EF4444;">{{ $demandes->where('statut', 'refuse')->count() }}</strong>
        </div>
        <div style="padding:16px 20px; background:var(--color-background-secondary); border-radius:10px; flex:1; min-width:140px;">
            <p style="font-size:12px; color:var(--color-text-secondary); margin:0 0 4px;">Total</p>
            <strong style="font-size:24px;">{{ $demandes->count() }}</strong>
        </div>
    </div>

    {{-- Liste des demandes --}}
    <article class="admin-card">
        <div style="overflow-x: auto;">
            <div class="admin-table" style="min-width: 750px;">

                {{-- En-tête --}}
                <div class="admin-table__row admin-table__row--head" style="grid-template-columns: 2fr 1.5fr 1fr 1fr 1.5fr;">
                    <span>Demandeur</span>
                    <span>Groupe</span>
                    <span>Type</span>
                    <span>Statut</span>
                    <span>Actions</span>
                </div>

                @forelse ($demandes as $demande)
                    <div class="admin-table__row" style="grid-template-columns: 2fr 1.5fr 1fr 1fr 1.5fr; align-items:start; padding:16px 0;">

                        {{-- Demandeur --}}
                        <div>
                            <strong style="font-size:14px; display:block;">{{ $demande->user->name }}</strong>
                            <small style="color:var(--color-text-secondary);">{{ $demande->user->email }}</small>
                            <br>
                            <small style="color:var(--color-text-tertiary);">📞 {{ $demande->telephone }}</small>
                            <br>
                            <small style="color:var(--color-text-tertiary);">{{ $demande->created_at->diffForHumans() }}</small>
                        </div>

                        {{-- Groupe --}}
                        <div>
                            <strong style="font-size:13px; display:block;">{{ $demande->nom_groupe }}</strong>
                            <small style="color:var(--color-text-secondary); line-height:1.5; display:block; margin-top:4px;">
                                {{ Str::limit($demande->description, 80) }}
                            </small>
                        </div>

                        {{-- Type --}}
                        <div>
                            <span style="font-size:12px; padding:3px 8px; border-radius:20px; background:var(--color-background-tertiary); color:var(--color-text-secondary);">
                                @switch($demande->type_evenements)
                                    @case('concert') 🎵 Concert @break
                                    @case('gala') 🎭 Gala @break
                                    @case('sport') ⚽ Sport @break
                                    @case('culturel') 🎨 Culturel @break
                                    @case('conference') 🎤 Conférence @break
                                    @default ✨ Autre
                                @endswitch
                            </span>
                        </div>

                        {{-- Statut --}}
                        <div>
                            @if ($demande->statut === 'en_attente')
                                <span style="font-size:12px; padding:3px 8px; border-radius:20px; background:#FFF8E1; color:#92400E; font-weight:500;">
                                    ⏳ En attente
                                </span>
                            @elseif ($demande->statut === 'approuve')
                                <span style="font-size:12px; padding:3px 8px; border-radius:20px; background:#E1F5EE; color:#085041; font-weight:500;">
                                    ✅ Approuvée
                                </span>
                            @elseif ($demande->statut === 'refuse')
                                <span style="font-size:12px; padding:3px 8px; border-radius:20px; background:#FEE2E2; color:#991B1B; font-weight:500;">
                                    ❌ Refusée
                                </span>
                                @if ($demande->message_refus)
                                    <small style="display:block; margin-top:4px; color:var(--color-text-secondary); font-size:11px;">
                                        {{ Str::limit($demande->message_refus, 50) }}
                                    </small>
                                @endif
                            @endif
                        </div>

                        {{-- Actions --}}
                        <div style="display:flex; flex-direction:column; gap:8px;">
                            @if ($demande->statut === 'en_attente')

                                {{-- Bouton Approuver --}}
                                <form action="{{ route('admin.demandes.approuver', $demande) }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="admin-btn admin-btn--success"
                                        style="width:100%; padding:6px 12px; background:#1D9E75; color:white; border:none; border-radius:6px; font-size:12px; cursor:pointer;"
                                        onclick="return confirm('Approuver la demande de {{ $demande->user->name }} pour le groupe {{ $demande->nom_groupe }} ?')">
                                        ✅ Approuver
                                    </button>
                                </form>

                                {{-- Formulaire Refuser --}}
<div>
    <button
        type="button"
        style="width:100%; padding:6px 12px; background:#EF4444; color:white; border:none; border-radius:6px; font-size:12px; cursor:pointer;"
        onclick="
            var el = document.getElementById('refus-{{ $demande->id }}');
            el.hidden = !el.hidden;
        ">
        ❌ Refuser
    </button>

    <div id="refus-{{ $demande->id }}" hidden style="margin-top:8px; background:var(--color-background-secondary); border:1px solid var(--color-border-secondary); border-radius:8px; padding:12px;">
        <p style="font-size:12px; color:var(--color-text-secondary); margin:0 0 8px; font-weight:500;">
             Raison du refus :
        </p>
        <form action="{{ route('admin.demandes.refuser', $demande) }}" method="POST">
            @csrf
            <textarea
    name="message_refus"
    rows="3"
    placeholder="Ex: Dossier incomplet, informations insuffisantes..."
    required
    style="width:100%; padding:8px 12px; border-radius:6px; border:1px solid #ffffff50; background:var(--color-background-primary); color:var(--color-text-primary); font-size:12px; resize:vertical; box-sizing:border-box; font-family:inherit; outline:none;">
</textarea>
            <div style="display:flex; gap:8px; margin-top:8px;">
                <button
                    type="button"
                    onclick="document.getElementById('refus-{{ $demande->id }}').hidden = true"
                    style="flex:1; padding:6px 12px; background:transparent; border:1px solid var(--color-border-secondary); border-radius:6px; font-size:12px; color:var(--color-text-secondary); cursor:pointer;">
                    Annuler
                </button>
                <button
                    type="submit"
                    style="flex:1; padding:6px 12px; background:#EF4444; color:white; border:none; border-radius:6px; font-size:12px; cursor:pointer;">
                    Confirmer
                </button>
            </div>
        </form>
    </div>
</div>

                            @elseif ($demande->statut === 'approuve')
                                <span style="font-size:12px; color:var(--color-text-secondary);">
                                    Organisateur actif
                                </span>

                            @elseif ($demande->statut === 'refuse')
                                {{-- Permettre de réapprouver --}}
                                <form action="{{ route('admin.demandes.approuver', $demande) }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        style="width:100%; padding:6px 12px; background:var(--color-background-secondary); color:var(--color-text-primary); border:1px solid var(--color-border-secondary); border-radius:6px; font-size:12px; cursor:pointer;">
                                        Réapprouver
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                @empty
                    <div style="padding:40px; text-align:center; color:var(--color-text-secondary);">
                        <div style="font-size:48px; margin-bottom:16px;">📋</div>
                        <strong style="display:block; margin-bottom:8px;">Aucune demande</strong>
                        <span style="font-size:13px;">Les demandes d'organisateurs apparaîtront ici.</span>
                    </div>
                @endforelse

            </div>
        </div>
    </article>

</section>