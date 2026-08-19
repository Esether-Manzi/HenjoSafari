@php
    $chartColors = ['#D4A017', '#2E7D32', '#1565C0', '#7B1818', '#00897B', '#6A4C93'];
    $maxCountry = max(1, collect($byCountry)->max('total') ?? 1);
    $totalCustomers = max(1, $repeatCustomers + $newCustomers);
    $repeatPct = round(($repeatCustomers / $totalCustomers) * 100);
    $newPct = 100 - $repeatPct;
@endphp

<x-filament-widgets::widget>
    <div class="henjo-stat-card">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-base font-semibold text-gray-950 dark:text-white">Customers by Country</h3>
            <x-filament::button size="sm" color="gray" icon="heroicon-o-arrow-down-tray" wire:click="exportByCountry">
                Export
            </x-filament::button>
        </div>

        @if (empty($byCountry))
            <p class="text-sm text-gray-500 dark:text-gray-400">No customers yet.</p>
        @else
            <div class="mb-6">
                @foreach ($byCountry as $i => $row)
                    <div class="henjo-progress-row">
                        <div class="flex items-center gap-3 mb-1.5">
                            <span class="henjo-rank-badge" style="background: {{ $chartColors[$i % 6] }};">
                                {{ $i + 1 }}
                            </span>
                            <span class="text-sm font-medium text-gray-950 dark:text-white flex-1 truncate">
                                {{ $row['country'] }}
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                {{ $row['total'] }} {{ Str::plural('customer', $row['total']) }}
                            </span>
                        </div>
                        <div class="henjo-progress-track">
                            <div
                                class="henjo-progress-fill"
                                style="width: {{ max(4, ($row['total'] / $maxCountry) * 100) }}%; background: {{ $chartColors[$i % 6] }};"
                            ></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="pt-5" style="border-top: 1px solid var(--henjo-border);">
            <h4 class="text-sm font-semibold text-gray-950 dark:text-white mb-3">Repeat vs. New Customers</h4>

            <div class="flex h-3 rounded-full overflow-hidden mb-3" style="background: var(--henjo-border);">
                <div style="width: {{ $repeatPct }}%; background: #D4A017;"></div>
                <div style="width: {{ $newPct }}%; background: #2E7D32;"></div>
            </div>

            <div class="flex items-center gap-6 text-sm">
                <span class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full" style="background: #D4A017;"></span>
                    <span class="text-gray-700 dark:text-gray-300">Repeat ({{ $repeatCustomers }} · {{ $repeatPct }}%)</span>
                </span>
                <span class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full" style="background: #2E7D32;"></span>
                    <span class="text-gray-700 dark:text-gray-300">New ({{ $newCustomers }} · {{ $newPct }}%)</span>
                </span>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
