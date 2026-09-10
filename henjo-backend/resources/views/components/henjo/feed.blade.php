@props([
    'items' => [],   // array of ['title' => string|Htmlable, 'meta' => string, 'time' => string, 'url' => ?string, 'accent' => string]
])

<div class="henjo-feed">
    @forelse ($items as $item)
        @php $accent = $item['accent'] ?? 'green'; @endphp
        <div class="henjo-feed-item">
            <span class="henjo-feed-dot" style="--henjo-feed-accent: var(--henjo-hue-{{ $accent }})"></span>
            <div class="henjo-feed-body">
                <div class="henjo-feed-title">
                    @if (! empty($item['url']))
                        <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                    @else
                        {{ $item['title'] }}
                    @endif
                </div>
                <div class="henjo-feed-meta">
                    {{ $item['meta'] ?? '' }}@if (! empty($item['meta']) && ! empty($item['time'])) <span aria-hidden="true">&middot;</span> @endif{{ $item['time'] ?? '' }}
                </div>
            </div>
        </div>
    @empty
        <p class="text-sm" style="color: var(--henjo-text-muted)">Nothing to show yet.</p>
    @endforelse
</div>
