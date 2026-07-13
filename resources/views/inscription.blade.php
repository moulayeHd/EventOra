@extends('layouts.app')

@section('title', 'Inscription - EventOra')

@section('content')
    <section class="page-hero compact-hero">
        <div class="hero-inner narrow">
            <p class="eyebrow pill"><span></span>Nouveau compte</p>
            <h1>Inscription EventOra</h1>
            <p class="hero-copy">Créez votre compte participant.</p>
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

            <input type="hidden" name="role" value="utilisateur">

            <div class="form-row">
                <label>
                    Mot de passe
                    <div style="position:relative;">
                        <input type="password" name="password" id="password-field" placeholder="8 caracteres minimum" required style="padding-right:45px; width:100%;">
                        <button type="button" onclick="togglePassword('password-field', 'eye-icon-1')" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:transparent; border:none; cursor:pointer; padding:0; color:rgba(226,232,255,0.6);">
                            <svg id="eye-icon-1" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                </label>
                <label>
                    Confirmation
                    <div style="position:relative;">
                        <input type="password" name="password_confirmation" id="password-confirm-field" placeholder="Repetez le mot de passe" required style="padding-right:45px; width:100%;">
                        <button type="button" onclick="togglePassword('password-confirm-field', 'eye-icon-2')" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:transparent; border:none; cursor:pointer; padding:0; color:rgba(226,232,255,0.6);">
                            <svg id="eye-icon-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                </label>
            </div>

            <button class="btn btn-primary" type="submit">S'inscrire</button>
            <a class="text-link" href="{{ route('login') }}">J'ai deja un compte</a>
        </form>
    </section>

    <script>
        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (field.type === 'password') {
                field.type = 'text';
                icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
            } else {
                field.type = 'password';
                icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
            }
        }
    </script>
@endsection