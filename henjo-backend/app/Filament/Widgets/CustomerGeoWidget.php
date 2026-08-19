<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Concerns\ExportsCsv;
use App\Models\Customer;
use Filament\Widgets\Widget;

class CustomerGeoWidget extends Widget
{
    use ExportsCsv;

    protected string $view = 'filament.widgets.customer-geo';

    protected int|string|array $columnSpan = 2;

    protected static ?int $sort = 7;

    public array $byCountry = [];

    public int $repeatCustomers = 0;

    public int $newCustomers = 0;

    public function mount(): void
    {
        $this->byCountry = Customer::query()
            ->selectRaw("COALESCE(NULLIF(country, ''), 'Unknown') as country, COUNT(*) as total")
            ->groupBy('country')
            ->orderByDesc('total')
            ->get()
            ->map(fn ($row) => ['country' => $row->country, 'total' => (int) $row->total])
            ->all();

        $bookingCounts = Customer::query()->withCount('bookings')->get();
        $this->repeatCustomers = $bookingCounts->where('bookings_count', '>', 1)->count();
        $this->newCustomers = $bookingCounts->where('bookings_count', '<=', 1)->count();
    }

    public function exportByCountry()
    {
        return $this->exportCsv(
            'customers-by-country-' . now()->format('Y-m-d') . '.csv',
            ['Country', 'Customers'],
            collect($this->byCountry)->map(fn ($row) => [$row['country'], $row['total']]),
        );
    }
}
