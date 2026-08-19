<x-filament-widgets::widget>
    <div class="space-y-6">
        <div>
            <span
                class="inline-block text-xs font-bold uppercase tracking-widest px-2.5 py-1 rounded-full mb-3"
                style="background: var(--henjo-badge-maroon-bg); color: var(--henjo-badge-maroon-fg);"
            >
                Booking &amp; Inquiry Health
            </span>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="henjo-stat-card">
                    <div class="flex items-start justify-between mb-3">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Overdue Pending<br>(7+ days)</span>
                        <span class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background: var(--henjo-badge-maroon-bg); color: var(--henjo-badge-maroon-fg);">
                            <x-filament::icon icon="heroicon-o-exclamation-triangle" class="w-4 h-4" />
                        </span>
                    </div>
                    <p class="text-2xl font-bold text-gray-950 dark:text-white">{{ $this->getOverduePendingCount() }}</p>
                </div>
                <div class="henjo-stat-card">
                    <div class="flex items-start justify-between mb-3">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Cancelled Bookings</span>
                        <span class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background: var(--henjo-badge-gold-bg); color: var(--henjo-badge-gold-fg);">
                            <x-filament::icon icon="heroicon-o-x-circle" class="w-4 h-4" />
                        </span>
                    </div>
                    <p class="text-2xl font-bold text-gray-950 dark:text-white">{{ $this->getCancelledCount() }}</p>
                </div>
                <div class="henjo-stat-card">
                    <div class="flex items-start justify-between mb-3">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Unresolved Inquiries</span>
                        <span class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background: var(--henjo-badge-blue-bg); color: var(--henjo-badge-blue-fg);">
                            <x-filament::icon icon="heroicon-o-envelope" class="w-4 h-4" />
                        </span>
                    </div>
                    <p class="text-2xl font-bold text-gray-950 dark:text-white">{{ $this->getUnresolvedInquiriesCount() }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="henjo-stat-card">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-gray-950 dark:text-white">Overdue Pending Bookings</h3>
                    <x-filament::button size="sm" color="gray" icon="heroicon-o-arrow-down-tray" wire:click="exportOverduePending">
                        Export
                    </x-filament::button>
                </div>

                @if (empty($overduePending))
                    <p class="text-sm text-gray-500 dark:text-gray-400">Nothing overdue — all pending bookings are recent.</p>
                @else
                    <div class="space-y-2">
                        @foreach ($overduePending as $row)
                            <div class="flex items-center justify-between gap-3 py-2 px-3 rounded-lg" style="background: var(--henjo-badge-maroon-bg);">
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-950 dark:text-white truncate">{{ $row['booking_number'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $row['customer'] }}</p>
                                </div>
                                <span class="text-xs font-bold px-2 py-1 rounded-full whitespace-nowrap" style="background: var(--henjo-maroon); color: #fff;">
                                    {{ $row['days_old'] }}d
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="henjo-stat-card">
                <h3 class="text-base font-semibold text-gray-950 dark:text-white mb-4">Unresolved Inquiries</h3>

                @if (empty($unresolvedInquiries))
                    <p class="text-sm text-gray-500 dark:text-gray-400">No unresolved inquiries.</p>
                @else
                    <div class="space-y-2">
                        @foreach ($unresolvedInquiries as $row)
                            <div class="flex items-center justify-between gap-3 py-2 px-3 rounded-lg" style="background: var(--henjo-badge-blue-bg);">
                                <p class="text-sm font-medium text-gray-950 dark:text-white truncate">{{ $row['name'] }}</p>
                                <div class="flex items-center gap-2 whitespace-nowrap">
                                    <span class="text-xs font-bold px-2 py-1 rounded-full capitalize" style="background: var(--henjo-badge-blue-fg); color: #fff;">
                                        {{ $row['status'] }}
                                    </span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $row['created_at']->format('M j') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
