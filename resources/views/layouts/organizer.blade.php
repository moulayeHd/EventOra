<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Espace organisateur - EventOra')</title>
    <link rel="stylesheet" href="{{ asset('css/organizer.css') }}">
</head>
<body class="organizer-body" data-organizer-shell>
    <div class="organizer-noise" aria-hidden="true"></div>
    <div class="organizer-mobile-overlay" data-sidebar-overlay></div>

    <div class="organizer-shell">
        @include('organizer.partials.sidebar')

        <div class="organizer-main">
            @include('organizer.partials.topbar')

            <main class="organizer-content" id="organizer-content">
                @if (session('success'))
                    <div class="organizer-flash organizer-flash--success" role="status">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="organizer-flash organizer-flash--error" role="alert">
                        <strong>Veuillez corriger le formulaire.</strong>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @include('organizer.partials.create-event-modal')

    <script src="{{ asset('js/organizer.js') }}" defer></script>
</body>
</html>
