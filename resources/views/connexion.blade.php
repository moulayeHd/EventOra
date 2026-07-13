@extends('layouts.app')

@section('title', 'Connexion - EventOra')

@section('content')
    <section class="page-hero compact-hero">
        <div class="hero-inner narrow">
            <p class="eyebrow pill"><span></span>Acces securise</p>
            <h1>Connexion</h1>
            <p class="hero-copy">Connectez-vous pour reserver, gerer vos billets ou acceder a votre espace organisateur.</p>
        </div>
    </section>

    <section class="contact-section section-pad">
        <form class="contact-form auth-form" action="{{ route('login.store') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="form-alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <label>
                Email
                <input type="email" name="email" value="{{ old('email') }}" placeholder="exemple@email.com" required>
            </label>

            <label>
                Mot de passe
                <div style="position:relative;">
                    <input type="password" name="password" id="password-field" placeholder="Votre mot de passe" required style="padding-right:45px; width:100%;">
                    <button type="button" onclick="togglePassword()" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:transparent; border:none; cursor:pointer; padding:0; color:rgba(226,232,255,0.6);">
                        <svg id="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                            <line x1="1" y1="1" x2="23" y2="23"/>
                        </svg>
                    </button>
                </div>
            </label>

            <label class="check-row">
                <input type="checkbox" name="remember" value="1">
                Se souvenir de moi
            </label>

            <button class="btn btn-primary" type="submit">Se connecter</button>
            <a class="text-link" href="{{ route('inscription') }}">Creer un compte</a>
        </form>
    </section>

    <script>
        function togglePassword() {
            const field = document.getElementById('password-field');
            const icon = document.getElementById('eye-icon');
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