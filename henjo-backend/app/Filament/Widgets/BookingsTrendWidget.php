<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class BookingsTrendWidget extends ChartWidget
{
    protected ?string $heading = 'Bookings — Last 14 Days';

    protected string $color = 'info';

    protected int|string|array $columnSpan = 2;

    protected static ?int $sort = 3;

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
                    'fill' => true,
                ],
            ],
            'labels' => $days->map(fn (Carbon $day) => $day->format('M j'))->all(),
        ];
    }
}
