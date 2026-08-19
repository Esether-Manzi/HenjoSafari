<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueTrendWidget extends ChartWidget
{
    protected ?string $heading = 'Revenue — Last 12 Months';

    protected ?string $description = 'Quoted booking value by month (all currencies combined).';

    protected int|string|array $columnSpan = 2;

    protected static ?int $sort = 2;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $months = collect(range(11, 0))->map(fn (int $monthsAgo) => Carbon::today()->subMonths($monthsAgo)->startOfMonth());

        $totalsByMonth = Booking::query()
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(quoted_price) as total")
            ->where('created_at', '>=', $months->first())
            ->groupBy('month')
            ->pluck('total', 'month');

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $months->map(fn (Carbon $month) => (float) ($totalsByMonth[$month->format('Y-m')] ?? 0))->all(),
                    'borderColor' => '#D4A017',
                    'backgroundColor' => 'rgba(212, 160, 23, 0.18)',
                    'pointBackgroundColor' => '#D4A017',
                    'pointBorderColor' => '#fff',
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $months->map(fn (Carbon $month) => $month->format('M Y'))->all(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => ['display' => false],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'grid' => ['color' => 'rgba(150, 150, 150, 0.1)'],
                ],
                'x' => [
                    'grid' => ['display' => false],
                ],
            ],
        ];
    }
}
