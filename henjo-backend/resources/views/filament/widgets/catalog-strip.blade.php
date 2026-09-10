<x-filament-widgets::widget>
    <div>
        <x-henjo.section-title title="Catalog at a glance" icon="heroicon-o-rectangle-stack" accent="gold" />

        <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-3">
            @foreach ($items as $item)
                <x-henjo.mini-stat
                    :label="$item['label']"
                    :value="$item['value']"
                    :icon="$item['icon']"
                    :accent="$item['accent']"
                    :url="$item['url']"
                />
            @endforeach
        </div>
    </div>
</x-filament-widgets::widget>
