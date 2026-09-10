@props([
    'title' => '',
    'icon' => null,
    'accent' => 'green',
])

<div class="henjo-section-title" style="--henjo-st-accent-bg: var(--henjo-badge-{{ $accent }}-bg); --henjo-st-accent-fg: var(--henjo-badge-{{ $accent }}-fg)">
    @if ($icon)
        <span class="henjo-section-title-icon">
            <x-filament::icon :icon="$icon" />
        </span>
    @endif
    <h3>{{ $title }}</h3>
    @if (isset($action))
        <span class="henjo-section-title-action">{{ $action }}</span>
    @endif
</div>
