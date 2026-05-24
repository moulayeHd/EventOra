@props([
    'icon' => 'chart',
    'label',
    'value',
    'trend' => null,
    'tone' => 'violet',
])

<article class="organizer-stat organizer-reveal" data-searchable>
    <div class="organizer-stat__top">
        <span class="organizer-icon organizer-icon--{{ $tone }}">
            <x-organizer.icon :name="$icon" />
        </span>
        @if ($trend)
            <span class="organizer-trend">{{ $trend }}</span>
        @endif
    </div>
    <strong>{{ $value }}</strong>
    <span>{{ $label }}</span>
</article>
