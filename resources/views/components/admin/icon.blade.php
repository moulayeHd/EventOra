@props(['name' => 'dashboard', 'class' => ''])

@php
    $icons = [
        'dashboard' => '<path d="M4 4h6v6H4z"></path><path d="M14 4h6v6h-6z"></path><path d="M4 14h6v6H4z"></path><path d="M14 14h6v6h-6z"></path>',
        'users' => '<path d="M16 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"></path><circle cx="9.5" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>',
        'calendar' => '<path d="M8 2v4"></path><path d="M16 2v4"></path><path d="M3 10h18"></path><rect x="3" y="4" width="18" height="18" rx="4"></rect><path d="M8 14h.01"></path><path d="M12 14h.01"></path><path d="M16 14h.01"></path>',
        'settings' => '<path d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path><path d="M19.4 15a1.8 1.8 0 0 0 .36 1.98l.05.05a2 2 0 1 1-2.83 2.83l-.05-.05a1.8 1.8 0 0 0-1.98-.36 1.8 1.8 0 0 0-1.1 1.66V21a2 2 0 1 1-4 0v-.08A1.8 1.8 0 0 0 8.74 19.25a1.8 1.8 0 0 0-1.98.36l-.05.05a2 2 0 1 1-2.83-2.83l.05-.05a1.8 1.8 0 0 0 .36-1.98 1.8 1.8 0 0 0-1.66-1.1H2.5a2 2 0 1 1 0-4h.08a1.8 1.8 0 0 0 1.66-1.1 1.8 1.8 0 0 0-.36-1.98l-.05-.05A2 2 0 1 1 6.66 3.74l.05.05a1.8 1.8 0 0 0 1.98.36H8.8A1.8 1.8 0 0 0 9.9 2.5V2.4a2 2 0 1 1 4 0v.08a1.8 1.8 0 0 0 1.1 1.66 1.8 1.8 0 0 0 1.98-.36l.05-.05a2 2 0 1 1 2.83 2.83l-.05.05a1.8 1.8 0 0 0-.36 1.98v.1a1.8 1.8 0 0 0 1.66 1.1h.08a2 2 0 1 1 0 4h-.08A1.8 1.8 0 0 0 19.4 15z"></path>',
        'bell' => '<path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 7h18s-3 0-3-7"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path>',
        'plus' => '<path d="M12 5v14"></path><path d="M5 12h14"></path>',
        'search' => '<circle cx="11" cy="11" r="7"></circle><path d="m20 20-3.5-3.5"></path>',
        'edit' => '<path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path>',
        'trash' => '<path d="M3 6h18"></path><path d="M8 6V4h8v2"></path><path d="M19 6l-1 14H6L5 6"></path><path d="M10 11v5"></path><path d="M14 11v5"></path>',
        'ticket' => '<path d="M4 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2a2 2 0 0 0 0 4v2a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2a2 2 0 0 0 0-4z"></path><path d="M9 8v8"></path><path d="M15 8v8"></path>',
        'trend' => '<path d="m3 17 6-6 4 4 7-7"></path><path d="M14 8h6v6"></path>',
        'wallet' => '<path d="M3 7a3 3 0 0 1 3-3h13v16H6a3 3 0 0 1-3-3z"></path><path d="M16 12h5v4h-5a2 2 0 0 1 0-4z"></path>',
        'shield' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>',
        'menu' => '<path d="M4 7h16"></path><path d="M4 12h16"></path><path d="M4 17h16"></path>',
        'x' => '<path d="M18 6 6 18"></path><path d="m6 6 12 12"></path>',
        'logout' => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><path d="M16 17l5-5-5-5"></path><path d="M21 12H9"></path>',
        'arrow' => '<path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path>',
    ];
@endphp

<svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    {!! $icons[$name] ?? $icons['dashboard'] !!}
</svg>
