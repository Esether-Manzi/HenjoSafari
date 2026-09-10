<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Bookings\BookingResource;
use App\Filament\Resources\Destinations\DestinationResource;
use App\Filament\Resources\Inquiries\InquiryResource;
use App\Filament\Resources\SafariPackages\SafariPackageResource;
use App\Models\Booking;
use App\Models\Inquiry;
use Filament\Widgets\Widget;

class DashboardWelcomeWidget extends Widget
{
    protected string $view = 'filament.widgets.dashboard-welcome';

    protected static ?int $sort = 0;

    protected int|string|array $columnSpan = 'full';

    public string $greeting = 'Welcome back';

    public string $today = '';

    public ?string $statusLine = null;

    public array $actions = [];

    public function mount(): void
    {
        $hour = now()->hour;
        $this->greeting = match (true) {
            $hour < 12 => 'Good morning',
            $hour < 18 => 'Good afternoon',
            default => 'Good evening',
        };

        $this->today = now()->format('l, j F Y');

        $pendingBookings = Booking::where('status', 'pending')->count();
        $newInquiries = Inquiry::where('status', 'new')->count();

        $parts = [];
        if ($pendingBookings > 0) {
            $parts[] = $pendingBookings.' '.str('booking')->plural($pendingBookings).' to review';
        }
        if ($newInquiries > 0) {
            $parts[] = $newInquiries.' new '.str('inquiry')->plural($newInquiries);
        }

        $this->statusLine = $parts === []
            ? 'Everything is up to date. Nothing needs your attention right now.'
            : 'You have '.implode(' and ', $parts).'.';

        $this->actions = [
            ['label' => 'New booking', 'icon' => 'heroicon-o-plus-circle', 'url' => $this->safeUrl(fn () => BookingResource::getUrl('create'))],
            ['label' => 'New safari package', 'icon' => 'heroicon-o-map', 'url' => $this->safeUrl(fn () => SafariPackageResource::getUrl('create'))],
            ['label' => 'New destination', 'icon' => 'heroicon-o-map-pin', 'url' => $this->safeUrl(fn () => DestinationResource::getUrl('create'))],
            ['label' => 'View inquiries', 'icon' => 'heroicon-o-inbox', 'url' => $this->safeUrl(fn () => InquiryResource::getUrl('index'))],
        ];
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
