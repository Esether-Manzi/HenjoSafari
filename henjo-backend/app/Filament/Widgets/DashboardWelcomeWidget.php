<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\Widget;

class DashboardWelcomeWidget extends Widget
{
    protected string $view = 'filament.widgets.dashboard-welcome';

    protected static ?int $sort = 0;

    protected int|string|array $columnSpan = 'full';

    public ?string $lastEntryLabel = null;

    public function mount(): void
    {
        $lastBooking = Booking::latest()->first();

        $this->lastEntryLabel = $lastBooking
            ? $lastBooking->created_at->diffForHumans()
            : 'No entries yet';
    }
}
