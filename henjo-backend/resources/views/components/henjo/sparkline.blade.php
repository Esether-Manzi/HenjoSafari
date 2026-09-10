@props([
    'points' => [],
    'accent' => 'green',
    'filled' => true,
    'height' => 40,
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
    $stroke = $hues[$accent] ?? $accent;

    $values = array_values(array_map('floatval', $points));
    $count = count($values);

    $w = 100;
    $h = 32;
    $pad = 2;

    if ($count < 2) {
        $values = $count === 1 ? [$values[0], $values[0]] : [0, 0];
        $count = 2;
    }

    $min = min($values);
    $max = max($values);
    $range = ($max - $min) ?: 1;

    $stepX = ($w - $pad * 2) / ($count - 1);

    $coords = [];
    foreach ($values as $i => $v) {
        $x = round($pad + $i * $stepX, 2);
        $y = round($h - $pad - (($v - $min) / $range) * ($h - $pad * 2), 2);
        $coords[] = "{$x},{$y}";
    }

    $line = implode(' ', $coords);
    $area = "M {$coords[0]} L " . implode(' ', array_slice($coords, 1)) . " L " . round($pad + ($count - 1) * $stepX, 2) . ",{$h} L {$pad},{$h} Z";
    $gradId = 'hspark-' . \Illuminate\Support\Str::random(6);
    $lastX = round($pad + ($count - 1) * $stepX, 2);
    $lastY = round($h - $pad - (($values[$count - 1] - $min) / $range) * ($h - $pad * 2), 2);
@endphp

<svg class="henjo-spark" viewBox="0 0 {{ $w }} {{ $h }}" preserveAspectRatio="none" style="height: {{ $height }}px" aria-hidden="true">
    @if ($filled)
        <defs>
            <linearGradient id="{{ $gradId }}" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="{{ $stroke }}" stop-opacity="0.28" />
                <stop offset="100%" stop-color="{{ $stroke }}" stop-opacity="0" />
            </linearGradient>
        </defs>
        <path d="{{ $area }}" fill="url(#{{ $gradId }})" />
    @endif
    <polyline
        points="{{ $line }}"
        fill="none"
        stroke="{{ $stroke }}"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        vector-effect="non-scaling-stroke"
    />
    <circle cx="{{ $lastX }}" cy="{{ $lastY }}" r="2.4" fill="{{ $stroke }}" vector-effect="non-scaling-stroke" />
</svg>
