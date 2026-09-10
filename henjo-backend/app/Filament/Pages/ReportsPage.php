<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BookingHealthWidget;
use App\Filament\Widgets\BookingsReportWidget;
use App\Filament\Widgets\BookingStatusChartWidget;
use App\Filament\Widgets\CustomerGeoWidget;
use App\Filament\Widgets\InquiriesReportWidget;
use App\Filament\Widgets\InquiryStatusChartWidget;
use App\Filament\Widgets\PackagePerformanceWidget;
use App\Filament\Widgets\RevenueTrendWidget;
use App\Models\Booking;
use App\Models\Inquiry;
use Filament\Pages\Page;

class ReportsPage extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected string $view = 'filament.pages.reports';

    protected static ?string $navigationLabel = 'Reports';

    protected static ?string $title = 'Reports';

    protected static string|\UnitEnum|null $navigationGroup = 'Reports';

    protected static ?int $navigationSort = 1;

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getSummaryCards(): array
    {
        $totalBookings = Booking::count();
        $totalRevenue = (float) Booking::sum('quoted_price');
        $avgValue = $totalBookings > 0 ? $totalRevenue / $totalBookings : 0.0;
        $confirmedRate = $totalBookings > 0
            ? Booking::whereIn('status', ['confirmed', 'completed'])->count() / $totalBookings * 100
            : 0.0;
        $totalInquiries = Inquiry::count();

        return [
            [
                'label' => 'Total revenue (all time)',
                'value' => round($totalRevenue),
                'format' => 'currency',
                'icon' => 'heroicon-o-banknotes',
                'accent' => 'gold',
                'hint' => $totalBookings.' bookings',
            ],
            [
                'label' => 'Total bookings',
                'value' => $totalBookings,
                'format' => 'number',
                'icon' => 'heroicon-o-calendar-days',
                'accent' => 'green',
                'hint' => $totalInquiries.' inquiries received',
            ],
            [
                'label' => 'Average booking value',
                'value' => round($avgValue),
                'format' => 'currency',
                'icon' => 'heroicon-o-calculator',
                'accent' => 'blue',
                'hint' => 'per booking',
            ],
            [
                'label' => 'Confirmed + completed rate',
                'value' => round($confirmedRate),
                'format' => 'number',
                'suffix' => '%',
                'icon' => 'heroicon-o-check-badge',
                'accent' => 'teal',
                'hint' => 'of all bookings',
            ],
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            BookingsReportWidget::class,
            RevenueTrendWidget::class,
            BookingStatusChartWidget::class,
            PackagePerformanceWidget::class,
            InquiriesReportWidget::class,
            InquiryStatusChartWidget::class,
            CustomerGeoWidget::class,
            BookingHealthWidget::class,
        ];
    }

    public function getFooterWidgetsColumns(): int|array
    {
        return 3;
    }
}
