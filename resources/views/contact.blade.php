@extends('layouts.app')

@section('title', 'Contact - EventOra')

@section('content')
    <section class="page-hero compact-hero">
        <div class="hero-inner narrow">
            <p class="eyebrow pill"><span></span>Contact</p>
            <h1>Parlons de votre prochain événement.</h1>
            <p class="hero-copy">Que vous prépariez une conférence, un festival ou un gala, notre équipe vous aide à transformer l’idée en expérience fluide.</p>
        </div>
    </section>

    <section class="contact-section section-pad">
        <div class="contact-grid">
            <div class="contact-copy">
                <p class="eyebrow">Restons connectés</p>
                <h2>Une question, une démo ou un projet à cadrer ?</h2>
                <p>Envoyez-nous quelques détails. Nous revenons vers vous avec une réponse claire et les prochaines étapes adaptées à votre événement.</p>
                <div class="contact-facts">
                    <div>
                        <span>Email</span>
                        <strong>contact@eventora.com</strong>
                    </div>
                    <div>
                        <span>Support</span>
                        <strong>Disponible 24/7</strong>
                    </div>
                </div>
            </div>

            <form class="contact-form" action="#" method="post">
                @csrf
                <div class="form-row">
                    <label>
                        <span>Prénom</span>
                        <input type="text" name="first_name" placeholder="Awa">
                    </label>
                    <label>
                        <span>Nom</span>
                        <input type="text" name="last_name" placeholder="Coulibaly">
                    </label>
                </div>
                <label>
                    <span>Email</span>
                    <input type="email" name="email" placeholder="awa@exemple.com">
                </label>
                <label>
                    <span>Votre message</span>
                    <textarea name="message" rows="6" placeholder="Dites-nous en plus sur votre projet..."></textarea>
                </label>
                <button class="btn btn-primary" type="submit">Envoyer le message</button>
            </form>
        </div>
    </section>
@endsection
