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
                <input type="password" name="password" placeholder="Votre mot de passe" required>
            </label>

            <label class="check-row">
                <input type="checkbox" name="remember" value="1">
                Se souvenir de moi
            </label>

            <button class="btn btn-primary" type="submit">Se connecter</button>
            <a class="text-link" href="{{ route('inscription') }}">Creer un compte</a>
        </form>
    </section>
@endsection
