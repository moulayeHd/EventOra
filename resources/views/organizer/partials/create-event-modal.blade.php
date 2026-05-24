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

            <label>
                Image de l'evenement
                <input type="file" name="image" accept="image/png,image/jpeg,image/webp">
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

            <div class="organizer-form__grid">
                <label>
                    Type de billet
                    <input type="text" name="ticket_type" value="{{ old('ticket_type', 'Standard') }}" placeholder="Standard" required>
                </label>

                <label>
                    Prix du billet
                    <input type="number" name="ticket_price" min="0" step="0.01" value="{{ old('ticket_price') }}" placeholder="5000" required>
                </label>
            </div>

            <label>
                Quantite de tickets
                <input type="number" name="ticket_quantity" min="1" value="{{ old('ticket_quantity') }}" placeholder="100" required>
            </label>

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
