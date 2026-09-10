<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BookingsTrendWidget;
use App\Filament\Widgets\CatalogStripWidget;
use App\Filament\Widgets\DashboardBookingStatusWidget;
use App\Filament\Widgets\DashboardKpiWidget;
use App\Filament\Widgets\DashboardWelcomeWidget;
use App\Filament\Widgets\RecentActivityWidget;
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
     * Three-column grid so the trend + donut and the table + activity feed
     * rows sit two-thirds / one-third. Full-width widgets manage their own
     * inner grids.
     */
    public function getColumns(): int|array
    {
        return ['default' => 1, 'md' => 2, 'lg' => 3];
    }

    /**
     * Explicit list rather than the default Filament::getWidgets() (every
     * auto-discovered widget) — keeps report-only widgets off the homepage.
     */
    public function getWidgets(): array
    {
        return [
            DashboardWelcomeWidget::class,
            DashboardKpiWidget::class,
            CatalogStripWidget::class,
            BookingsTrendWidget::class,
            DashboardBookingStatusWidget::class,
            RecentBookingsWidget::class,
            RecentActivityWidget::class,
        ];
    }
}
