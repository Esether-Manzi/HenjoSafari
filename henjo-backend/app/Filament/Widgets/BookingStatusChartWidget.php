<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;

class BookingStatusChartWidget extends ChartWidget
{
    protected ?string $heading = 'Bookings by Status';

    protected int|string|array $columnSpan = 1;

    protected static ?int $sort = 3;

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $statuses = ['pending' => 'Pending', 'confirmed' => 'Confirmed', 'completed' => 'Completed', 'cancelled' => 'Cancelled'];

        $counts = Booking::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            'datasets' => [
                [
                    'data' => collect($statuses)->keys()->map(fn ($status) => (int) ($counts[$status] ?? 0))->all(),
                    'backgroundColor' => [
                        '#D4A017',
                        '#1565C0',
                        '#2E7D32',
                        '#7B1818',
                    ],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => array_values($statuses),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => ['boxWidth' => 12, 'padding' => 16],
                ],
            ],
            'cutout' => '65%',
        ];
    }
}
