<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BookingsTrendWidget;
use App\Filament\Widgets\DashboardStatsWidget;
use App\Filament\Widgets\DashboardWelcomeWidget;
use App\Filament\Widgets\QuickActionsWidget;
use App\Filament\Widgets\RecentBookingsWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    public function getHeading(): string|Htmlable|null
    {
        return null;
    }

    /**
     * Explicit list rather than the default Filament::getWidgets() (every
     * auto-discovered widget) — keeps report-only widgets off the homepage.
     */
    public function getWidgets(): array
    {
        return [
            DashboardWelcomeWidget::class,
            DashboardStatsWidget::class,
            QuickActionsWidget::class,
            BookingsTrendWidget::class,
            RecentBookingsWidget::class,
        ];
    }
}
