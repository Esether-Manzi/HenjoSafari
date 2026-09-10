@props([
    'label' => '',
    'value' => 0,
    'icon' => 'heroicon-o-square-3-stack-3d',
    'accent' => 'green',
    'url' => null,
])

@php
    $tag = $url ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if ($url) href="{{ $url }}" @endif
    {{ $attributes->class('henjo-mini-stat') }}
    style="--henjo-mini-accent-bg: var(--henjo-badge-{{ $accent }}-bg); --henjo-mini-accent-fg: var(--henjo-badge-{{ $accent }}-fg)"
>
    <span class="henjo-mini-icon">
        <x-filament::icon :icon="$icon" />
    </span>
    <span>
        <span class="henjo-mini-value">{{ is_numeric($value) ? number_format($value) : $value }}</span>
        <span class="henjo-mini-label">{{ $label }}</span>
    </span>
</{{ $tag }}>
