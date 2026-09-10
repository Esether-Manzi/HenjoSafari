<x-filament-widgets::widget>
    <div class="henjo-card p-5 h-full" style="border-top: 3px solid var(--henjo-hue-teal)">
        <x-henjo.section-title title="Recent activity" icon="heroicon-o-clock" accent="teal" />
        <x-henjo.feed :items="$items" />
    </div>
</x-filament-widgets::widget>
