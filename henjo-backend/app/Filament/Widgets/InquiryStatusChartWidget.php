<?php

namespace App\Filament\Widgets;

use App\Models\Inquiry;
use Filament\Widgets\ChartWidget;

class InquiryStatusChartWidget extends ChartWidget
{
    protected ?string $heading = 'Inquiries by Status';

    protected int|string|array $columnSpan = 1;

    protected static ?int $sort = 6;

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $statuses = ['new' => 'New', 'contacted' => 'Contacted', 'closed' => 'Closed'];

        $counts = Inquiry::query()
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
