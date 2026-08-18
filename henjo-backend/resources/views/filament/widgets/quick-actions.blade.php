<x-filament-widgets::widget>
    <div>
        <span class="inline-block text-xs font-bold uppercase tracking-widest px-2.5 py-1 rounded-full mb-3 text-gray-500 dark:text-gray-400">
            Quick Actions
        </span>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach ($actions as $action)
                <a
                    href="{{ $action['url'] }}"
                    class="rounded-2xl p-4 flex flex-col items-center text-center gap-3 transition hover:-translate-y-0.5"
                    style="background: var(--henjo-bg-card); border: 1px solid var(--henjo-border); box-shadow: var(--henjo-shadow-md);"
                >
                    <span
                        class="w-11 h-11 rounded-full flex items-center justify-center"
                        style="background: var(--henjo-badge-{{ $action['accent'] }}-bg); color: var(--henjo-badge-{{ $action['accent'] }}-fg);"
                    >
                        <x-filament::icon :icon="$action['icon']" class="w-5 h-5" />
                    </span>
                    <span class="text-sm font-semibold text-gray-950 dark:text-white">
                        {{ $action['label'] }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</x-filament-widgets::widget>
