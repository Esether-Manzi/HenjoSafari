<x-filament-panels::page>
    <div class="henjo-welcome p-6 md:p-7">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-white/55">Analytics</p>
                <h2 class="text-xl md:text-2xl font-bold text-white mt-0.5">Reports &amp; insights</h2>
                <p class="text-sm text-white/75 mt-1">
                    Deeper breakdowns beyond the dashboard totals &mdash; revenue, popularity, inquiries,
                    customer geography and booking health. Every section exports to CSV.
                </p>
            </div>
            <span class="henjo-chip">
                <x-filament::icon icon="heroicon-o-clock" />
                Live &middot; all-time data
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        @foreach ($this->getSummaryCards() as $card)
            <x-henjo.kpi-card
                :label="$card['label']"
                :value="$card['value']"
                :format="$card['format'] ?? 'number'"
                :suffix="$card['suffix'] ?? ''"
                :icon="$card['icon']"
                :accent="$card['accent']"
                :hint="$card['hint'] ?? null"
            />
        @endforeach
    </div>
</x-filament-panels::page>
