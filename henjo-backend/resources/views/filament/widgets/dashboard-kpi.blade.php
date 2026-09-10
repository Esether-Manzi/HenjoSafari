<x-filament-widgets::widget>
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        @foreach ($cards as $card)
            <x-henjo.kpi-card
                :label="$card['label']"
                :value="$card['value']"
                :format="$card['format']"
                :icon="$card['icon']"
                :accent="$card['accent']"
                :delta="$card['delta']"
                :delta-dir="$card['deltaDir']"
                :hint="$card['hint']"
                :spark="$card['spark']"
            />
        @endforeach
    </div>
</x-filament-widgets::widget>
