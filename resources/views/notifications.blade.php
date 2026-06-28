@extends('layouts.app')

@section('title', 'Notifications - EventOra')

@section('content')
    <section class="page-hero compact-hero">
        <div class="hero-inner narrow">
            <p class="eyebrow pill"><span></span>Centre de notifications</p>
            <h1>Mes notifications</h1>
        </div>
    </section>

    <section class="contact-section section-pad">
        <div class="contact-form" style="padding: 5pxpx;">

            {{-- Header avec bouton tout lire --}}
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
                <p style="color:var(--color-text-secondary); font-size:14px;">
                    {{ $notifications->count() }} notification(s)
                </p>
                @if ($notifications->where('lu', false)->count() > 0)
                    <form action="{{ route('notifications.toutLire') }}" method="POST">
                        @csrf
                        <button class="btn btn-glass" type="submit" style="font-size:13px; padding: 6px 14px;">
                            Tout marquer comme lu
                        </button>
                    </form>
                @endif
            </div>

            {{-- Liste des notifications --}}
            @forelse ($notifications as $notification)
                <div style="
                    display:flex;
                    gap:16px;
                    align-items:flex-start;
                    padding:16px;
                    border-radius:10px;
                    margin-bottom:12px;
                    border: 1px solid var(--color-border-secondary);
                    background: {{ $notification->lu ? 'var(--color-background-secondary)' : 'var(--color-background-primary)' }};
                    {{ !$notification->lu ? 'border-left: 3px solid #1D9E75;' : '' }}
                ">
                    {{-- Icône selon le type --}}
                    <div style="font-size:24px; flex-shrink:0;">
                        @if ($notification->type === 'succes')
                            ✅
                        @elseif ($notification->type === 'refus')
                            ❌
                        @else
                            ℹ️
                        @endif
                    </div>

                    {{-- Contenu --}}
                    <div style="flex:1;">
                        <strong style="font-size:14px; display:block; margin-bottom:4px;">
                            {{ $notification->titre }}
                            @if (!$notification->lu)
                                <span style="display:inline-block; width:8px; height:8px; background:#1D9E75; border-radius:50%; margin-left:6px;"></span>
                            @endif
                        </strong>
                        <p style="font-size:13px; color:var(--color-text-secondary); margin:0 0 8px; line-height:1.6;">
                            {{ $notification->message }}
                        </p>
                        <small style="color:var(--color-text-tertiary);">
                            {{ $notification->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
            @empty
                <div style="text-align:center; padding:60px 20px;">
                    <div style="font-size:48px; margin-bottom:16px;">🔔</div>
                    <h3 style="margin-bottom:8px;">Aucune notification</h3>
                    <p style="color:var(--color-text-secondary);">
                        Vous serez notifié ici des décisions importantes.
                    </p>
                </div>
            @endforelse

        </div>
    </section>
@endsection