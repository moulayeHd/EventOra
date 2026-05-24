<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration - EventOra')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body" data-admin-shell>
    <div class="admin-noise" aria-hidden="true"></div>
    <div class="admin-mobile-overlay" data-admin-sidebar-overlay></div>

    <div class="admin-shell">
        @include('admin.partials.sidebar')

        <div class="admin-main">
            @include('admin.partials.topbar')

            <main class="admin-content" id="admin-content">
                @if (session('success'))
                    <div class="admin-flash admin-flash--success" role="status">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="admin-flash admin-flash--error" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <div class="admin-toast" data-admin-toast-box hidden></div>

    <script src="{{ asset('js/admin.js') }}" defer></script>
</body>
</html>
