@extends('layouts.app')

@section('title', 'Demande en attente - EventOra')

@section('content')
    <section class="page-hero compact-hero">
        <div class="hero-inner narrow">
            <p class="eyebrow pill"><span></span>Demande en cours</p>
            <h1>Votre demande est en attente</h1>
        </div>
    </section>

    <section class="contact-section section-pad">
        <div class="contact-form" style="text-align:center; padding: 40px;">

            {{-- Icône --}}
            <div style="font-size: 64px; margin-bottom: 24px;">⏳</div>

            {{-- Message principal --}}
            <h2 style="margin-bottom: 16px;">
                Bienvenue {{ auth()->user()->name }} !
            </h2>

            <p style="color: var(--color-text-secondary); max-width: 480px; margin: 0 auto 32px; line-height: 1.7;">
                Votre demande pour devenir organisateur sur EventOra
                a bien été reçue. Notre administrateur va examiner
                votre profil et vous notifier de sa décision
                dans les plus brefs délais.
            </p>

            {{-- Étapes --}}
            <div style="display:flex; flex-direction:column; gap:12px; max-width:400px; margin: 0 auto 40px; text-align:left;">
                <div style="display:flex; align-items:center; gap:12px; padding:14px 16px; background:var(--color-background-secondary); border-radius:10px;">
                    <span style="font-size:20px;">✅</span>
                    <div>
                        <strong style="font-size:14px;">Inscription complétée</strong>
                        <p style="font-size:12px; color:var(--color-text-secondary); margin:0;">Votre compte a été créé avec succès</p>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:12px; padding:14px 16px; background:#FFF8E1; border-radius:10px; border: 1px solid #F59E0B;">
                    <span style="font-size:20px;">⏳</span>
                    <div>
                        <strong style="font-size:14px; color:#92400E;">Validation en cours</strong>
                        <p style="font-size:12px; color:#92400E; margin:0;">L'administrateur examine votre demande</p>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:12px; padding:14px 16px; background:var(--color-background-secondary); border-radius:10px; opacity:0.5;">
                    <span style="font-size:20px;">🎉</span>
                    <div>
                        <strong style="font-size:14px;">Accès organisateur</strong>
                        <p style="font-size:12px; color:var(--color-text-secondary); margin:0;">Vous pourrez créer vos événements</p>
                    </div>
                </div>
            </div>

            {{-- Boutons --}}
            <div style="display:flex; gap:12px; justify-content:center; flex-wrap:wrap;">
                <a class="btn btn-glass" href="{{ route('events') }}">
                    Voir les événements
                </a>
                <a class="btn btn-primary" href="{{ route('demande.organisateur.form') }}">
                    Compléter ma demande
                </a>
            </div>

        </div>
    </section>
@endsection