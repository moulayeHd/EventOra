<div class="organizer-modal" data-create-modal aria-hidden="true">
    <div class="organizer-modal__overlay" data-close-create></div>

    <section class="organizer-modal__panel" role="dialog" aria-modal="true" aria-labelledby="create-event-title">
        <div class="organizer-modal__head">
            <div>
                <p class="organizer-kicker">EventOra Studio</p>
                <h2 id="create-event-title">Creer un evenement</h2>
            </div>
            <button class="organizer-icon-button" type="button" data-close-create aria-label="Fermer">
                <x-organizer.icon name="x" />
            </button>
        </div>

        <form class="organizer-form" action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="source" value="organizer">

            <label>
                Nom de l'evenement
                <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Tech Summit 2026" required>
            </label>

            <label>
                Description
                <textarea name="description" rows="4" placeholder="Presentez l'experience, le public et le programme." required>{{ old('description') }}</textarea>
            </label>

           {{-- Image optionnelle --}}
<label>
    Image de l'evenement (optionnelle)
    <label for="image-input" style="display:flex; align-items:center; gap:10px; padding:10px 14px; border:1px solid var(--color-border-secondary); border-radius:8px; background:var(--color-background-secondary); cursor:pointer;">
        <span style="padding:7px 14px; background:#1D9E75; border-radius:6px; font-size:12px; color:white; font-weight:600; white-space:nowrap;">
             Choisir un fichier
        </span>
        <span id="file-name" style="font-size:12px; color:var(--color-text-secondary);">
            Aucun fichier choisi
        </span>
    </label>
    <input type="file" id="image-input" name="image" accept="image/png,image/jpeg,image/webp" style="position:absolute; width:1px; height:1px; opacity:0; overflow:hidden;">
</label>

            <div class="organizer-form__grid">
                <label>
                    Date
                    <input type="date" name="date" value="{{ old('date') }}" required>
                </label>

                <label>
                    Lieu
                    <select name="espace_id" required>
                        <option value="">Choisir un espace</option>
                        @foreach ($espaces as $espace)
                            <option value="{{ $espace->id }}" @selected(old('espace_id') == $espace->id)>
                                {{ $espace->nom }} - {{ $espace->localisation }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="organizer-form__grid">
                <label>
                    Debut
                    <input type="time" name="heure_debut" value="{{ old('heure_debut', '09:00') }}" required>
                </label>

                <label>
                    Fin
                    <input type="time" name="heure_fin" value="{{ old('heure_fin', '18:00') }}" required>
                </label>
            </div>

            {{-- Types de billets --}}
            <div style="margin-bottom:16px;">
                <p style="font-size:11px; font-weight:600; letter-spacing:0.08em; color:var(--color-text-secondary); margin:0 0 12px; text-transform:uppercase;">
                    Types de billets
                </p>

                <div id="billets-container">
                    {{-- Billet par défaut --}}
                    <div class="billet-row" style="background:var(--color-background-secondary); border:1px solid var(--color-border-secondary); border-radius:10px; padding:16px; margin-bottom:10px; position:relative;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                            <strong style="font-size:13px; color:var(--color-text-primary); text-transform:none; letter-spacing:0; font-weight:600;">Billet 1</strong>
                            <button type="button" onclick="supprimerBillet(this)" style="padding:4px 8px; background:transparent; border:1px solid #EF4444; border-radius:6px; color:#EF4444; cursor:pointer; font-size:12px; text-transform:none; letter-spacing:0; font-weight:400;">
                                🗑️ Supprimer
                            </button>
                        </div>
                        <div class="organizer-form__grid">
                            <label style="text-transform:none; letter-spacing:0; font-size:12px;">
                                Type
                                <select name="billets[0][type]" required style="padding:8px 12px; border-radius:8px; border:1px solid var(--color-border-secondary); background:var(--color-background-primary); color:var(--color-text-primary); font-size:13px; width:100%;">
                                    <option value="Standard">Standard</option>
                                    <option value="VIP">VIP</option>
                                    <option value="VVIP">VVIP</option>
                                    <option value="Etudiant">Etudiant</option>
                                    <option value="Early Bird">Early Bird</option>
                                </select>
                            </label>
                            <label style="text-transform:none; letter-spacing:0; font-size:12px;">
                                Prix (FCFA)
                                <input type="number" name="billets[0][prix]" min="0" placeholder="5000" required style="padding:8px 12px; border-radius:8px; border:1px solid var(--color-border-secondary); background:var(--color-background-primary); color:var(--color-text-primary); font-size:13px; width:100%;">
                            </label>
                        </div>
                        <label style="text-transform:none; letter-spacing:0; font-size:12px; margin-top:8px; display:block;">
                            Quantité de places
                            <input type="number" name="billets[0][quantite]" min="1" placeholder="100" required style="padding:8px 12px; border-radius:8px; border:1px solid var(--color-border-secondary); background:var(--color-background-primary); color:var(--color-text-primary); font-size:13px; width:100%;">
                        </label>
                    </div>
                </div>

                {{-- Bouton ajouter --}}
                <button
                    type="button"
                    onclick="ajouterBillet()"
                    style="display:flex; align-items:center; justify-content:center; gap:6px; padding:10px 14px; background:transparent; border:1px dashed var(--color-border-secondary); border-radius:10px; color:var(--color-text-secondary); font-size:13px; cursor:pointer; text-transform:none; font-weight:400; letter-spacing:0; width:100%;">
                    + Ajouter un type de billet
                </button>
            </div>

            <div class="organizer-modal__actions">
                <button class="organizer-secondary-action" type="button" data-close-create>Annuler</button>
                <button class="organizer-primary-action" type="submit">
                    <x-organizer.icon name="plus" />
                    <span>Creer l'evenement</span>
                </button>
            </div>
        </form>
    </section>
</div>

<script>
let billetIndex = 1;

function ajouterBillet() {
    const container = document.getElementById('billets-container');
    const numero = container.querySelectorAll('.billet-row').length + 1;
    const row = document.createElement('div');
    row.className = 'billet-row';
    row.style.cssText = 'background:var(--color-background-secondary); border:1px solid var(--color-border-secondary); border-radius:10px; padding:16px; margin-bottom:10px; position:relative;';

    row.innerHTML = `
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
            <strong style="font-size:13px; color:var(--color-text-primary); text-transform:none; letter-spacing:0; font-weight:600;">Billet ${numero}</strong>
            <button type="button" onclick="supprimerBillet(this)" style="padding:4px 8px; background:transparent; border:1px solid #EF4444; border-radius:6px; color:#EF4444; cursor:pointer; font-size:12px; text-transform:none; letter-spacing:0; font-weight:400;">
                🗑️ Supprimer
            </button>
        </div>
        <div class="organizer-form__grid">
            <label style="text-transform:none; letter-spacing:0; font-size:12px;">
                Type
                <select name="billets[${billetIndex}][type]" required style="padding:8px 12px; border-radius:8px; border:1px solid var(--color-border-secondary); background:var(--color-background-primary); color:var(--color-text-primary); font-size:13px; width:100%;">
                    <option value="Standard">Standard</option>
                    <option value="VIP">VIP</option>
                    <option value="VVIP">VVIP</option>
                    <option value="Etudiant">Etudiant</option>
                    <option value="Early Bird">Early Bird</option>
                </select>
            </label>
            <label style="text-transform:none; letter-spacing:0; font-size:12px;">
                Prix (FCFA)
                <input type="number" name="billets[${billetIndex}][prix]" min="0" placeholder="5000" required style="padding:8px 12px; border-radius:8px; border:1px solid var(--color-border-secondary); background:var(--color-background-primary); color:var(--color-text-primary); font-size:13px; width:100%;">
            </label>
        </div>
        <label style="text-transform:none; letter-spacing:0; font-size:12px; margin-top:8px; display:block;">
            Quantité de places
            <input type="number" name="billets[${billetIndex}][quantite]" min="1" placeholder="100" required style="padding:8px 12px; border-radius:8px; border:1px solid var(--color-border-secondary); background:var(--color-background-primary); color:var(--color-text-primary); font-size:13px; width:100%;">
        </label>
    `;

    container.appendChild(row);
    billetIndex++;
}

function supprimerBillet(btn) {
    const rows = document.querySelectorAll('.billet-row');
    if (rows.length === 1) {
        alert('Vous devez avoir au moins un type de billet.');
        return;
    }
    btn.closest('.billet-row').remove();

    // Renuméroter les billets
    document.querySelectorAll('.billet-row').forEach((row, index) => {
        row.querySelector('strong').textContent = 'Billet ' + (index + 1);
    });
    
}
document.getElementById('image-input').addEventListener('change', function () {
    document.getElementById('file-name').textContent = this.files[0]?.name || 'Aucun fichier choisi';
});
</script>
