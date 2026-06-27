@extends('layouts.app')

@section('title', 'Inscription - EventOra')

@section('content')
    <section class="page-hero compact-hero">
        <div class="hero-inner narrow">
            <p class="eyebrow pill"><span></span>Nouveau compte</p>
            <h1>Inscription EventOra</h1>
            <p class="hero-copy">Créez un compte participant ou organisateur.</p>
        </div>
    </section>

    <section class="contact-section section-pad">
        <form class="contact-form auth-form" action="{{ route('inscription.store') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="form-alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="form-row">
                <label>
                    Prenom
                    <input type="text" name="prenom" value="{{ old('prenom') }}" placeholder="Prenom" required>
                </label>
                <label>
                    Nom
                    <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Nom" required>
                </label>
            </div>

            <label>
                Email
                <input type="email" name="email" value="{{ old('email') }}" placeholder="exemple@email.com" required>
            </label>

            <label>
                Role
                <select name="role" required>
                    <option value="utilisateur" @selected(old('role') === 'utilisateur')>Utilisateur</option>
                    <option value="organisateur" @selected(old('role') === 'organisateur')>Organisateur</option>
                    {{-- Option administrateur supprimée --}}
                </select>
            </label>

            {{-- Message informatif si organisateur choisi --}}
            <div id="msg-organisateur" style="display:none; background:#FFF8E1; border-left: 3px solid #F59E0B; padding: 10px 14px; border-radius: 6px; font-size: 13px; color: #92400E; margin-top: -8px;">
                ⏳ Votre demande sera examinée par l'administrateur avant activation.
            </div>

            <div class="form-row">
                <label>
                    Mot de passe
                    <input type="password" name="password" placeholder="8 caracteres minimum" required>
                </label>
                <label>
                    Confirmation
                    <input type="password" name="password_confirmation" placeholder="Repetez le mot de passe" required>
                </label>
            </div>

            <button class="btn btn-primary" type="submit">S'inscrire</button>
            <a class="text-link" href="{{ route('login') }}">J'ai deja un compte</a>
        </form>
    </section>

    {{-- Script pour afficher le message si organisateur est choisi --}}
    <script>
        const select = document.querySelector('select[name="role"]');
        const msg = document.getElementById('msg-organisateur');

        function toggleMsg() {
            msg.style.display = select.value === 'organisateur' ? 'block' : 'none';
        }

        select.addEventListener('change', toggleMsg);
        toggleMsg(); // Au chargement si old('role') = organisateur
    </script>
@endsection