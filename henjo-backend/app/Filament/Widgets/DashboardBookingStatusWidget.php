<?php

namespace App\Filament\Widgets;

/**
 * Dashboard-sized variant of {@see BookingStatusChartWidget} - same data and
 * doughnut, but spans one third of the dashboard's 3-column grid so it sits
 * beside the bookings trend. The Reports page keeps using the base widget.
 */
class DashboardBookingStatusWidget extends BookingStatusChartWidget
{
    protected ?string $heading = 'Bookings by status';

    protected ?string $description = 'All bookings, split by stage';

    protected int|string|array $columnSpan = ['default' => 'full', 'lg' => 1];

    protected ?string $maxHeight = '260px';

    protected static ?int $sort = 4;
}
