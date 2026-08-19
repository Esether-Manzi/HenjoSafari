@php
    $chartColors = ['#D4A017', '#2E7D32', '#1565C0', '#7B1818', '#00897B', '#6A4C93'];
    $maxPackageBookings = max(1, collect($packages)->max('bookings') ?? 1);
    $maxDestinationBookings = max(1, collect($destinations)->max('bookings') ?? 1);
@endphp

<x-filament-widgets::widget>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="henjo-stat-card">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-semibold text-gray-950 dark:text-white">Top Safari Packages</h3>
                <x-filament::button size="sm" color="gray" icon="heroicon-o-arrow-down-tray" wire:click="exportPackages">
                    Export
                </x-filament::button>
            </div>

            @if (empty($packages))
                <p class="text-sm text-gray-500 dark:text-gray-400">No bookings yet.</p>
            @else
                <div>
                    @foreach ($packages as $i => $package)
                        <div class="henjo-progress-row">
                            <div class="flex items-center gap-3 mb-1.5">
                                <span class="henjo-rank-badge" style="background: {{ $chartColors[$i % 6] }};">
                                    {{ $i + 1 }}
                                </span>
                                <span class="text-sm font-medium text-gray-950 dark:text-white flex-1 truncate" title="{{ $package['title'] }}">
                                    {{ $package['title'] }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                    {{ $package['bookings'] }} {{ Str::plural('booking', $package['bookings']) }} · {{ number_format($package['revenue'], 0) }}
                                </span>
                            </div>
                            <div class="henjo-progress-track">
                                <div
                                    class="henjo-progress-fill"
                                    style="width: {{ $package['bookings'] > 0 ? max(4, ($package['bookings'] / $maxPackageBookings) * 100) : 0 }}%; background: {{ $chartColors[$i % 6] }};"
                                ></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="henjo-stat-card">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-semibold text-gray-950 dark:text-white">Top Destinations</h3>
                <x-filament::button size="sm" color="gray" icon="heroicon-o-arrow-down-tray" wire:click="exportDestinations">
                    Export
                </x-filament::button>
            </div>

            @if (empty($destinations))
                <p class="text-sm text-gray-500 dark:text-gray-400">No bookings yet.</p>
            @else
                <div>
                    @foreach ($destinations as $i => $destination)
                        <div class="henjo-progress-row">
                            <div class="flex items-center gap-3 mb-1.5">
                                <span class="henjo-rank-badge" style="background: {{ $chartColors[$i % 6] }};">
                                    {{ $i + 1 }}
                                </span>
                                <span class="text-sm font-medium text-gray-950 dark:text-white flex-1 truncate" title="{{ $destination['name'] }}">
                                    {{ $destination['name'] }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                    {{ $destination['bookings'] }} {{ Str::plural('booking', $destination['bookings']) }} · {{ number_format($destination['revenue'], 0) }}
                                </span>
                            </div>
                            <div class="henjo-progress-track">
                                <div
                                    class="henjo-progress-fill"
                                    style="width: {{ $destination['bookings'] > 0 ? max(4, ($destination['bookings'] / $maxDestinationBookings) * 100) : 0 }}%; background: {{ $chartColors[$i % 6] }};"
                                ></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-filament-widgets::widget>
