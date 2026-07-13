@extends('layouts.app')

@section('title', 'Demande Organisateur - EventOra')

@section('content')
    <section class="page-hero compact-hero">
        <div class="hero-inner narrow">
            <p class="eyebrow pill"><span></span>Devenir organisateur</p>
            <h1>Complétez votre demande</h1>
            <p class="hero-copy">Remplissez ce formulaire pour que l'administrateur puisse examiner votre demande.</p>
        </div>
    </section>

    <section class="contact-section section-pad">
        <form class="contact-form" action="{{ route('demande.organisateur.store') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="form-alert">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="form-alert" style="background:#E1F5EE; color:#085041; border-color:#1D9E75;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Nom du groupe --}}
            <label>
                Nom du groupe / organisation
                <input
                    type="text"
                    name="nom_groupe"
                    value="{{ old('nom_groupe', $demande?->nom_groupe) }}"
                    placeholder="Ex: Les Lions de Bamako"
                    required>
            </label>

            {{-- Type d'événements --}}
            <label>
                Type d'événements que vous organisez
                <select name="type_evenements" required style="padding:10px 14px; border-radius:8px; border:1px solid var(--color-border-secondary); background:var(--color-background-secondary); color:var(--color-text-primary); font-size:14px; width:100%;">
                    <option value=""  style="background:#ffff; color:#0f0a1f;">-- Choisissez un type --</option>
                    <option value="concert"  style="background:#fff; color:#0f0a1f;"     @selected(old('type_evenements', $demande?->type_evenements) === 'concert')>🎵 Concert</option>
                    <option value="gala"  style="background:#fff; color:#0f0a1f;"        @selected(old('type_evenements', $demande?->type_evenements) === 'gala')>🎭 Gala</option>
                    <option value="sport"  style="background:#fff; color:#0f0a1f;"       @selected(old('type_evenements', $demande?->type_evenements) === 'sport')>⚽ Sport</option>
                    <option value="culturel"  style="background:#fff; color:#0f0a1f;"    @selected(old('type_evenements', $demande?->type_evenements) === 'culturel')>🎨 Culturel</option>
                    <option value="conference"  style="background:#fff; color:#0f0a1f;"  @selected(old('type_evenements', $demande?->type_evenements) === 'conference')>🎤 Conférence</option>
                    <option value="autre"  style="background:#fff; color:#0f0a1f;"       @selected(old('type_evenements', $demande?->type_evenements) === 'autre')>✨ Autre</option>
                </select>
            </label>

            {{-- Téléphone --}}
            <label>
                Numéro de téléphone
                <input
                    type="tel"
                    name="telephone"
                    value="{{ old('telephone', $demande?->telephone) }}"
                    placeholder="Ex: +223 70 00 00 00"
                    required>
            </label>

            {{-- Description --}}
            <label>
                Décrivez votre groupe / organisation
                <textarea
                    name="description"
                    rows="5"
                    placeholder="Qui êtes-vous ? Depuis quand organisez-vous des événements ? Quel est votre public cible ?"
                    required>{{ old('description', $demande?->description) }}</textarea>
            </label>

            {{-- Statut actuel si demande existante --}}
            @if ($demande)
                <div style="padding:14px 16px; border-radius:10px; margin-bottom:8px;
                    {{ $demande->estEnAttente() ? 'background:#FFF8E1; border:1px solid #F59E0B; color:#92400E;' : '' }}
                    {{ $demande->estApprouve() ? 'background:#E1F5EE; border:1px solid #1D9E75; color:#085041;' : '' }}
                    {{ $demande->estRefuse() ? 'background:#FEE2E2; border:1px solid #EF4444; color:#991B1B;' : '' }}">
                    @if ($demande->estEnAttente())
                        ⏳ Votre demande est en attente de validation.
                    @elseif ($demande->estApprouve())
                        ✅ Votre demande a été approuvée !
                    @elseif ($demande->estRefuse())
                        ❌ Votre demande a été refusée.
                        @if ($demande->message_refus)
                            <br><small>Raison : {{ $demande->message_refus }}</small>
                        @endif
                    @endif
                </div>
            @endif

            <button class="btn btn-primary" type="submit">
                {{ $demande ? 'Mettre à jour ma demande' : 'Envoyer ma demande' }}
            </button>
            <a class="text-link" href="{{ route('events') }}">Retour aux événements</a>
        </form>
    </section>
@endsection