<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Concerns\ExportsCsv;
use App\Models\Booking;
use App\Models\Inquiry;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class BookingHealthWidget extends Widget
{
    use ExportsCsv;

    protected string $view = 'filament.widgets.booking-health';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 8;

    public array $overduePending = [];

    public array $cancelled = [];

    public array $unresolvedInquiries = [];

    public function mount(): void
    {
        $sevenDaysAgo = Carbon::now()->subDays(7);

        $this->overduePending = Booking::query()
            ->where('status', 'pending')
            ->where('created_at', '<=', $sevenDaysAgo)
            ->with('customer')
            ->orderBy('created_at')
            ->limit(10)
            ->get()
            ->map(fn (Booking $b) => [
                'booking_number' => $b->booking_number,
                'customer' => $b->customer?->name ?? '—',
                'days_old' => (int) $b->created_at->diffInDays(now()),
            ])
            ->all();

        $this->cancelled = Booking::query()
            ->where('status', 'cancelled')
            ->with('customer')
            ->latest()
            ->limit(10)
            ->get()
            ->map(fn (Booking $b) => [
                'booking_number' => $b->booking_number,
                'customer' => $b->customer?->name ?? '—',
                'created_at' => $b->created_at,
            ])
            ->all();

        $this->unresolvedInquiries = Inquiry::query()
            ->whereIn('status', ['new', 'contacted'])
            ->latest()
            ->limit(10)
            ->get()
            ->map(fn (Inquiry $i) => [
                'name' => $i->name,
                'status' => $i->status,
                'created_at' => $i->created_at,
            ])
            ->all();
    }

    public function getOverduePendingCount(): int
    {
        return Booking::where('status', 'pending')->where('created_at', '<=', Carbon::now()->subDays(7))->count();
    }

    public function getCancelledCount(): int
    {
        return Booking::where('status', 'cancelled')->count();
    }

    public function getUnresolvedInquiriesCount(): int
    {
        return Inquiry::whereIn('status', ['new', 'contacted'])->count();
    }

    public function exportOverduePending()
    {
        $bookings = Booking::query()
            ->where('status', 'pending')
            ->where('created_at', '<=', Carbon::now()->subDays(7))
            ->with('customer')
            ->orderBy('created_at')
            ->get();

        return $this->exportCsv(
            'overdue-pending-bookings-' . now()->format('Y-m-d') . '.csv',
            ['Booking #', 'Customer', 'Days Pending'],
            $bookings->map(fn (Booking $b) => [$b->booking_number, $b->customer?->name, $b->created_at->diffInDays(now())]),
        );
    }
}
