<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Concerns\ExportsCsv;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\SafariPackage;
use Filament\Widgets\Widget;

class PackagePerformanceWidget extends Widget
{
    use ExportsCsv;

    protected string $view = 'filament.widgets.package-performance';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 4;

    public array $packages = [];

    public array $destinations = [];

    public function mount(): void
    {
        $this->packages = SafariPackage::query()
            ->withCount('bookings')
            ->withSum('bookings', 'quoted_price')
            ->orderByDesc('bookings_count')
            ->limit(10)
            ->get(['id', 'title'])
            ->map(fn (SafariPackage $p) => [
                'title' => $p->title,
                'bookings' => $p->bookings_count,
                'revenue' => (float) ($p->bookings_sum_quoted_price ?? 0),
            ])
            ->all();

        $destinationRows = Booking::query()
            ->join('safari_packages', 'safari_packages.id', '=', 'bookings.package_id')
            ->whereNotNull('safari_packages.destination_id')
            ->selectRaw('safari_packages.destination_id as destination_id, COUNT(*) as bookings_count, SUM(bookings.quoted_price) as revenue_sum')
            ->groupBy('safari_packages.destination_id')
            ->get()
            ->keyBy('destination_id');

        $this->destinations = Destination::query()
            ->whereIn('id', $destinationRows->keys())
            ->get(['id', 'name'])
            ->map(fn (Destination $d) => [
                'name' => $d->name,
                'bookings' => (int) $destinationRows[$d->id]->bookings_count,
                'revenue' => (float) $destinationRows[$d->id]->revenue_sum,
            ])
            ->sortByDesc('bookings')
            ->values()
            ->all();
    }

    public function exportPackages()
    {
        return $this->exportCsv(
            'package-performance-' . now()->format('Y-m-d') . '.csv',
            ['Package', 'Bookings', 'Revenue'],
            collect($this->packages)->map(fn ($p) => [$p['title'], $p['bookings'], $p['revenue']]),
        );
    }

    public function exportDestinations()
    {
        return $this->exportCsv(
            'destination-performance-' . now()->format('Y-m-d') . '.csv',
            ['Destination', 'Bookings', 'Revenue'],
            collect($this->destinations)->map(fn ($d) => [$d['name'], $d['bookings'], $d['revenue']]),
        );
    }
}
