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
use Filament\Pages\Page;

class ReportsPage extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected string $view = 'filament.pages.reports';

    protected static ?string $navigationLabel = 'Reports';

    protected static ?string $title = 'Reports';

    protected static string|\UnitEnum|null $navigationGroup = 'Reports';

    protected static ?int $navigationSort = 1;

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
