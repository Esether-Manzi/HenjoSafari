@php
    $user = filament()->auth()->user();
    $name = filament()->getUserName($user);
    $avatarUrl = $user instanceof \Filament\Models\Contracts\HasAvatar ? $user->getFilamentAvatarUrl() : null;
@endphp

<x-filament-widgets::widget>
    <div class="henjo-welcome p-6 md:p-7">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div class="flex items-center gap-4">
                @if ($avatarUrl)
                    <img
                        src="{{ $avatarUrl }}"
                        alt="{{ $name }}"
                        class="w-14 h-14 rounded-full object-cover flex-shrink-0"
                        style="border: 2px solid var(--henjo-gold);"
                    />
                @else
                    <div
                        class="w-14 h-14 rounded-full flex items-center justify-center font-bold text-xl flex-shrink-0"
                        style="background: var(--henjo-gold); color: #1A1A1A;"
                    >
                        {{ strtoupper(substr($name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-white/55">{{ $today }}</p>
                    <h2 class="text-xl md:text-2xl font-bold text-white mt-0.5">
                        {{ $greeting }}, {{ $name }}
                    </h2>
                    <p class="text-sm text-white/75 mt-1">{{ $statusLine }}</p>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                @foreach ($actions as $action)
                    @if ($action['url'])
                        <a href="{{ $action['url'] }}" class="henjo-chip">
                            <x-filament::icon :icon="$action['icon']" />
                            {{ $action['label'] }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
