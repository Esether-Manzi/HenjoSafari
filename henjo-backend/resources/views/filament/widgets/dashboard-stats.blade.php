<x-filament-widgets::widget>
    <div class="space-y-8">
        @foreach ($groups as $group)
            <div>
                <span
                    class="inline-block text-xs font-bold uppercase tracking-widest px-2.5 py-1 rounded-full mb-3"
                    style="background: var(--henjo-badge-{{ $group['accent'] }}-bg); color: var(--henjo-badge-{{ $group['accent'] }}-fg);"
                >
                    {{ $group['label'] }}
                </span>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach ($group['stats'] as $stat)
                        <div
                            class="rounded-2xl p-5"
                            style="background: var(--henjo-bg-card); border: 1px solid var(--henjo-border); box-shadow: var(--henjo-shadow-md);"
                        >
                            <div class="flex items-start justify-between mb-4 gap-2">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    {{ $stat['label'] }}
                                </span>
                                <span
                                    class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                                    style="background: var(--henjo-badge-{{ $group['accent'] }}-bg); color: var(--henjo-badge-{{ $group['accent'] }}-fg);"
                                >
                                    <x-filament::icon :icon="$stat['icon']" class="w-4 h-4" />
                                </span>
                            </div>
                            <p class="text-2xl font-bold text-gray-950 dark:text-white">
                                {{ $stat['value'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</x-filament-widgets::widget>
