<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BookingsTrendWidget;
use App\Filament\Widgets\DashboardStatsWidget;
use App\Filament\Widgets\DashboardWelcomeWidget;
use App\Filament\Widgets\QuickActionsWidget;
use App\Filament\Widgets\RecentBookingsWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
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
