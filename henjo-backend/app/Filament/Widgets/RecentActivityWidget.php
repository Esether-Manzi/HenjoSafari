<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Bookings\BookingResource;
use App\Filament\Resources\Inquiries\InquiryResource;
use App\Models\Booking;
use App\Models\Inquiry;
use Filament\Widgets\Widget;
use Illuminate\Support\Arr;

class RecentActivityWidget extends Widget
{
    protected string $view = 'filament.widgets.recent-activity';

    protected static ?int $sort = 6;

    protected int|string|array $columnSpan = ['default' => 'full', 'lg' => 1];

    public array $items = [];

    public function mount(): void
    {
        $bookings = Booking::query()
            ->with('customer')
            ->latest()
            ->limit(6)
            ->get()
            ->map(fn (Booking $b) => [
                'title' => trim(($b->customer?->name ?: 'A guest').' booked '.($b->safariPackage?->title ?? 'a safari')),
                'meta' => $b->booking_number,
                'time' => $b->created_at->diffForHumans(),
                'at' => $b->created_at,
                'url' => $this->safeUrl(fn () => BookingResource::getUrl('view', ['record' => $b])),
                'accent' => match ($b->status) {
                    'confirmed' => 'blue',
                    'completed' => 'green',
                    'cancelled' => 'maroon',
                    default => 'gold',
                },
            ]);

        $inquiries = Inquiry::query()
            ->latest()
            ->limit(6)
            ->get()
            ->map(fn (Inquiry $i) => [
                'title' => trim(($i->name ?: 'Someone').' asked: '.($i->subject ?: 'a question')),
                'meta' => $i->email,
                'time' => $i->created_at->diffForHumans(),
                'at' => $i->created_at,
                'url' => $this->safeUrl(fn () => InquiryResource::getUrl('view', ['record' => $i])),
                'accent' => 'teal',
            ]);

        $this->items = $bookings
            ->concat($inquiries)
            ->sortByDesc('at')
            ->take(8)
            ->map(fn ($item) => Arr::except($item, 'at'))
            ->values()
            ->all();
    }

    protected function safeUrl(\Closure $resolver): ?string
    {
        try {
            return $resolver();
        } catch (\Throwable) {
            return null;
        }
    }
}
