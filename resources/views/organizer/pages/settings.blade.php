<section class="organizer-panel" data-section-panel="settings" hidden>
    <div class="organizer-settings-grid">
        <article class="organizer-setting-card organizer-reveal" data-searchable>
            <span class="organizer-icon organizer-icon--violet"><x-organizer.icon name="users" /></span>
            <div>
                <h3>Profil</h3>
                <p>Nom, photo et informations de contact.</p>
            </div>
        </article>

        <article class="organizer-setting-card organizer-reveal" data-searchable>
            <span class="organizer-icon organizer-icon--cyan"><x-organizer.icon name="card" /></span>
            <div>
                <h3>Facturation</h3>
                <p>Plan, moyens de paiement et factures.</p>
            </div>
        </article>

        <article class="organizer-setting-card organizer-reveal" data-searchable>
            <span class="organizer-icon organizer-icon--emerald"><x-organizer.icon name="sparkles" /></span>
            <div>
                <h3>Integrations</h3>
                <p>Stripe, Google Calendar, Mailgun, Zapier.</p>
            </div>
        </article>

        <article class="organizer-setting-card organizer-reveal" data-searchable>
            <span class="organizer-icon organizer-icon--pink"><x-organizer.icon name="shield" /></span>
            <div>
                <h3>Securite</h3>
                <p>2FA, sessions et acces equipe.</p>
            </div>
        </article>
    </div>

    <article class="organizer-card organizer-card--profile organizer-reveal">
        <div class="organizer-card__head">
            <div>
                <h2>Profil</h2>
                <p>Controlez la maniere dont votre espace apparait dans EventOra.</p>
            </div>
        </div>

        <div class="organizer-profile-form">
            <label>
                Nom complet
                <input type="text" value="{{ $user->name }}" readonly>
            </label>

            <label>
                Email
                <input type="email" value="{{ $user->email }}" readonly>
            </label>

            <label>
                Organisation
                <input type="text" value="EventOra Events" readonly>
            </label>

            <label>
                Fuseau horaire
                <input type="text" value="Europe/Paris (CET)" readonly>
            </label>
        </div>

        <div class="organizer-modal__actions organizer-modal__actions--inline">
            <button class="organizer-secondary-action" type="button">Annuler</button>
            <button class="organizer-primary-action" type="button">Enregistrer</button>
        </div>
    </article>
</section>
