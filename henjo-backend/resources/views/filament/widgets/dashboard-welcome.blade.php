@php
    $user = filament()->auth()->user();
@endphp

<x-filament-widgets::widget>
    <div
        class="rounded-2xl p-6 md:p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6"
        style="background: linear-gradient(135deg, var(--henjo-green) 0%, var(--henjo-green-dark) 100%); box-shadow: var(--henjo-shadow-lg);"
    >
        <div class="flex items-center gap-4">
            <div
                class="w-14 h-14 rounded-full flex items-center justify-center font-bold text-xl flex-shrink-0"
                style="background: var(--henjo-gold); color: #1A1A1A;"
            >
                {{ strtoupper(substr(filament()->getUserName($user), 0, 1)) }}
            </div>
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-white">
                    Welcome back, {{ filament()->getUserName($user) }}
                </h2>
                <p class="text-xs font-semibold uppercase tracking-widest text-white/60 mt-1">
                    Last entry logged {{ $lastEntryLabel }}
                </p>
            </div>
        </div>

        <form action="{{ filament()->getLogoutUrl() }}" method="post">
            @csrf

            <x-filament::button
                color="gray"
                :icon="\Filament\Support\Icons\Heroicon::ArrowLeftEndOnRectangle"
                tag="button"
                type="submit"
            >
                Sign out
            </x-filament::button>
        </form>
    </div>
</x-filament-widgets::widget>
