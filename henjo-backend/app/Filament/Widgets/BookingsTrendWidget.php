<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class BookingsTrendWidget extends ChartWidget
{
    protected ?string $heading = 'Bookings — Last 14 Days';

    protected int|string|array $columnSpan = 2;

    protected static ?int $sort = 3;

    protected ?string $maxHeight = '180px';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $days = collect(range(13, 0))->map(fn (int $daysAgo) => Carbon::today()->subDays($daysAgo));

        $countsByDate = Booking::query()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', $days->first())
            ->groupBy('date')
            ->pluck('total', 'date');

        return [
            'datasets' => [
                [
                    'label' => 'Bookings',
                    'data' => $days->map(fn (Carbon $day) => (int) ($countsByDate[$day->toDateString()] ?? 0))->all(),
                    'borderColor' => '#2E7D32',
                    'backgroundColor' => 'rgba(46, 125, 50, 0.15)',
                    'pointBackgroundColor' => '#2E7D32',
                    'pointBorderColor' => '#fff',
                    'pointRadius' => 3,
                    'pointHoverRadius' => 5,
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $days->map(fn (Carbon $day) => $day->format('M j'))->all(),
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
                    'ticks' => ['stepSize' => 1],
                    'grid' => ['color' => 'rgba(150, 150, 150, 0.1)'],
                ],
                'x' => [
                    'grid' => ['display' => false],
                ],
            ],
        ];
    }
}
