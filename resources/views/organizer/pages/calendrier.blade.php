<section class="organizer-panel" data-section-panel="calendrier" hidden>
    <div class="organizer-section-toolbar">
        <h2 style="font-size:16px; font-weight:600;">Disponibilité des espaces</h2>
    </div>

    <article class="organizer-table-card organizer-reveal">
        <div style="padding: 24px;">

            {{-- Sélecteur d'espace + navigation mois --}}
            <div style="display:flex; gap:12px; margin-bottom:24px; flex-wrap:wrap; align-items:center;">
                <select id="calendrier-espace" style="padding:8px 12px; border-radius:8px; border:1px solid var(--color-border-secondary); background:var(--color-background-secondary); color:var(--color-text-primary); font-size:14px;">
                    @foreach ($tousLesEspaces as $espace)
                        <option value="{{ $espace->id }}">{{ $espace->nom }}</option>
                    @endforeach
                </select>

                <div style="display:flex; gap:8px; align-items:center;">
                    <button id="mois-precedent" class="organizer-icon-button" type="button">←</button>
                    <span id="mois-label" style="font-size:14px; font-weight:500; min-width:150px; text-align:center;"></span>
                    <button id="mois-suivant" class="organizer-icon-button" type="button">→</button>
                </div>
            </div>

            {{-- Grille du calendrier --}}
            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse; font-size:13px;">
                    <thead>
                        <tr>
                            @foreach (['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $jour)
                                <th style="padding:8px; text-align:center; color:var(--color-text-secondary); font-weight:500; font-size:12px;">
                                    {{ $jour }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody id="calendrier-body">
                        {{-- Rempli par JavaScript --}}
                    </tbody>
                </table>
            </div>

            {{-- Légende --}}
            <div style="display:flex; gap:24px; margin-top:20px; flex-wrap:wrap;">
                <div style="display:flex; align-items:center; gap:8px; font-size:13px; color:var(--color-text-secondary);">
                    <span style="width:12px; height:12px; border-radius:50%; background:#1D9E75; display:inline-block;"></span>
                    Disponible
                </div>
                <div style="display:flex; align-items:center; gap:8px; font-size:13px; color:var(--color-text-secondary);">
                    <span style="width:12px; height:12px; border-radius:50%; background:#EF4444; display:inline-block;"></span>
                    Occupé
                </div>
                <div style="display:flex; align-items:center; gap:8px; font-size:13px; color:var(--color-text-secondary);">
                    <span style="width:12px; height:12px; border-radius:50%; background:var(--color-border-secondary); display:inline-block;"></span>
                    Passé
                </div>
            </div>

            {{-- Liste des événements du mois --}}
            <div style="margin-top:28px;">
                <h3 style="font-size:14px; font-weight:600; margin-bottom:12px;">
                    Événements ce mois-ci sur cet espace
                </h3>
                <div id="liste-evenements">
                    {{-- Rempli par JavaScript --}}
                </div>
            </div>

        </div>
    </article>
</section>

{{-- Données JSON pour JavaScript --}}
<script>
const evenementsData = @json($evenementsParEspace);
const aujourdhui = new Date();
let moisActuel = aujourdhui.getMonth();
let anneeActuelle = aujourdhui.getFullYear();
let espaceSelectionne = document.getElementById('calendrier-espace')?.value;

const moisNoms = [
    'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
];

function genererCalendrier() {
    const label = document.getElementById('mois-label');
    if (!label) return;
    label.textContent = moisNoms[moisActuel] + ' ' + anneeActuelle;

    const premierJour = new Date(anneeActuelle, moisActuel, 1).getDay();
    const decalage = premierJour === 0 ? 6 : premierJour - 1;
    const dernierJour = new Date(anneeActuelle, moisActuel + 1, 0).getDate();

    // Jours occupés pour l'espace sélectionné
    const joursOccupes = new Set();
    const evenementsDuMois = [];

    const evenementsEspace = evenementsData[espaceSelectionne] || [];
    evenementsEspace.forEach(evt => {
        const date = new Date(evt.date);
        if (date.getMonth() === moisActuel && date.getFullYear() === anneeActuelle) {
            joursOccupes.add(date.getDate());
            evenementsDuMois.push(evt);
        }
    });

    // Générer les cellules du calendrier
    let html = '<tr>';
    let cellule = 0;

    // Cases vides au début
    for (let i = 0; i < decalage; i++) {
        html += '<td style="padding:6px;"></td>';
        cellule++;
    }

    for (let jour = 1; jour <= dernierJour; jour++) {
        const dateJour = new Date(anneeActuelle, moisActuel, jour);
        const estPasse = dateJour < new Date(aujourdhui.getFullYear(), aujourdhui.getMonth(), aujourdhui.getDate());
        const estOccupe = joursOccupes.has(jour);
        const estAujourdhui = dateJour.toDateString() === aujourdhui.toDateString();

        let couleur = '#1D9E75';
        if (estPasse) couleur = '#6B7280';
        if (estOccupe && !estPasse) couleur = '#EF4444';
        if (estOccupe && estPasse) couleur = '#EF4444';

        let bordure = estAujourdhui ? '2px solid var(--color-text-primary)' : 'none';

        html += `
            <td style="padding:6px; text-align:center;">
                <span style="
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 34px;
                    height: 34px;
                    border-radius: 50%;
                    background: ${couleur}22;
                    color: ${couleur};
                    font-weight: ${estAujourdhui ? '700' : '500'};
                    font-size: 13px;
                    border: ${bordure};
                    title: '${estOccupe ? 'Occupé' : estPasse ? 'Passé' : 'Disponible'}';
                ">
                    ${jour}
                </span>
            </td>
        `;

        cellule++;
        if (cellule % 7 === 0 && jour < dernierJour) {
            html += '</tr><tr>';
        }
    }

    // Cases vides à la fin
    while (cellule % 7 !== 0) {
        html += '<td style="padding:6px;"></td>';
        cellule++;
    }

    html += '</tr>';
    document.getElementById('calendrier-body').innerHTML = html;

    // Liste des événements du mois
    const liste = document.getElementById('liste-evenements');
    if (evenementsDuMois.length === 0) {
        liste.innerHTML = `
            <div style="padding:16px; text-align:center; color:var(--color-text-secondary); font-size:13px; background:var(--color-background-secondary); border-radius:10px;">
                Aucun événement ce mois-ci pour cet espace. Le lieu est entièrement disponible. ✅
            </div>
        `;
    } else {
        liste.innerHTML = evenementsDuMois
            .sort((a, b) => new Date(a.date) - new Date(b.date))
            .map(evt => {
                const date = new Date(evt.date);
                return `
                    <div style="display:flex; align-items:center; gap:12px; padding:12px 16px; border-radius:10px; background:var(--color-background-secondary); margin-bottom:8px; border-left:3px solid #EF4444;">
                        <span style="font-size:20px;">🔴</span>
                        <div>
                            <strong style="font-size:14px; display:block;">${evt.nom}</strong>
                            <p style="font-size:12px; color:var(--color-text-secondary); margin:2px 0 0;">
                                ${date.toLocaleDateString('fr-FR', {weekday:'long', day:'numeric', month:'long', year:'numeric'})}
                                · ${evt.heure_debut} → ${evt.heure_fin}
                            </p>
                        </div>
                    </div>
                `;
            }).join('');
    }
}

// Navigation entre les mois
document.getElementById('mois-precedent')?.addEventListener('click', () => {
    moisActuel--;
    if (moisActuel < 0) { moisActuel = 11; anneeActuelle--; }
    genererCalendrier();
});

document.getElementById('mois-suivant')?.addEventListener('click', () => {
    moisActuel++;
    if (moisActuel > 11) { moisActuel = 0; anneeActuelle++; }
    genererCalendrier();
});

// Changement d'espace
document.getElementById('calendrier-espace')?.addEventListener('change', function() {
    espaceSelectionne = this.value;
    genererCalendrier();
});

// Initialisation au chargement
document.addEventListener('DOMContentLoaded', function() {
    espaceSelectionne = document.getElementById('calendrier-espace')?.value;
    genererCalendrier();
});
</script>