@extends('layouts.app')

@section('title', 'Inscription - EventOra')

@section('content')
    <section class="page-hero compact-hero">
        <div class="hero-inner narrow">
            <p class="eyebrow pill"><span></span>Nouveau compte</p>
            <h1>Inscription EventOra</h1>
            <p class="hero-copy">Creez un compte participant ou organisateur. Le role administrateur reste reserve a la gestion interne.</p>
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
                    <option value="administrateur" @selected(old('role') === 'administrateur')>Administrateur</option>
                </select>
            </label>

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
@endsection
