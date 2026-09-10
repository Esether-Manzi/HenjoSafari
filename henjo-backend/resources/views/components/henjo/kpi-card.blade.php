@props([
    'label' => '',
    'value' => 0,          // raw numeric value to count up to
    'display' => null,      // optional pre-formatted string; overrides the counter
    'format' => 'number',   // number | currency
    'currency' => 'USD',
    'suffix' => '',
    'icon' => 'heroicon-o-chart-bar',
    'accent' => 'green',
    'delta' => null,        // e.g. "12.5%"  (string, no sign)
    'deltaDir' => 'flat',   // up | down | flat
    'hint' => null,
    'spark' => null,        // array of numbers
])

@php
    $hues = [
        'gold' => 'var(--henjo-hue-gold)',
        'green' => 'var(--henjo-hue-green)',
        'blue' => 'var(--henjo-hue-blue)',
        'maroon' => 'var(--henjo-hue-maroon)',
        'teal' => 'var(--henjo-hue-teal)',
        'purple' => 'var(--henjo-hue-purple)',
    ];
    $accentVar = $hues[$accent] ?? $accent;
    $numeric = (float) $value;
@endphp

<div class="henjo-kpi" style="--henjo-kpi-accent: {{ $accentVar }}">
    <div class="henjo-kpi-top">
        <span class="henjo-kpi-label">{{ $label }}</span>
        <span class="henjo-kpi-icon">
            <x-filament::icon :icon="$icon" />
        </span>
    </div>

    <div
        class="henjo-kpi-value henjo-count"
        @if ($display === null)
            x-data="{
                target: {{ $numeric }},
                shown: 0,
                fmt(n) {
                    @if ($format === 'currency')
                        return '{{ $currency }} ' + Math.round(n).toLocaleString() + @js($suffix);
                    @else
                        return Math.round(n).toLocaleString() + @js($suffix);
                    @endif
                },
            }"
            x-init="
                let start = null, dur = 1100;
                const step = (t) => {
                    if (!start) start = t;
                    let p = Math.min((t - start) / dur, 1);
                    p = 1 - Math.pow(1 - p, 3);
                    shown = target * p;
                    if (p < 1) requestAnimationFrame(step);
                    else shown = target;
                };
                requestAnimationFrame(step);
            "
            x-text="fmt(shown)"
        @endif
    >{{ $display ?? (($format === 'currency' ? $currency . ' ' : '') . number_format($numeric) . $suffix) }}</div>

    <div class="henjo-kpi-foot">
        @if ($delta !== null)
            <span class="henjo-delta henjo-delta--{{ $deltaDir }}">
                @if ($deltaDir === 'up')
                    <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 17a.75.75 0 0 1-.75-.75V5.612L5.29 9.77a.75.75 0 0 1-1.08-1.04l5.25-5.5a.75.75 0 0 1 1.08 0l5.25 5.5a.75.75 0 1 1-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0 1 10 17Z" clip-rule="evenodd" /></svg>
                @elseif ($deltaDir === 'down')
                    <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .75.75v10.638l3.96-4.158a.75.75 0 1 1 1.08 1.04l-5.25 5.5a.75.75 0 0 1-1.08 0l-5.25-5.5a.75.75 0 1 1 1.08-1.04l3.96 4.158V3.75A.75.75 0 0 1 10 3Z" clip-rule="evenodd" /></svg>
                @endif
                {{ $delta }}
            </span>
        @endif
        @if ($hint)
            <span class="henjo-kpi-hint">{{ $hint }}</span>
        @endif
    </div>

    @if (! empty($spark))
        <x-henjo.sparkline :points="$spark" :accent="$accent" />
    @endif
</div>
