<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Destination;
use App\Models\Inquiry;
use App\Models\Post;
use App\Models\SafariPackage;
use App\Models\Testimonial;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class DashboardStatsWidget extends Widget
{
    protected string $view = 'filament.widgets.dashboard-stats';

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    public array $groups = [];

    public function mount(): void
    {
        $today = Carbon::today();

        $this->groups = [
            [
                'label' => 'Catalog',
                'accent' => 'gold',
                'stats' => [
                    ['label' => 'Total Safari Packages', 'value' => SafariPackage::count(), 'icon' => Heroicon::OutlinedBookOpen],
                    ['label' => 'Total Destinations', 'value' => Destination::count(), 'icon' => Heroicon::OutlinedMapPin],
                ],
            ],
            [
                'label' => 'Bookings',
                'accent' => 'green',
                'stats' => [
                    ['label' => "Today's Bookings", 'value' => Booking::whereDate('created_at', $today)->count(), 'icon' => Heroicon::OutlinedCalendarDays],
                    ['label' => 'Pending Bookings', 'value' => Booking::where('status', 'pending')->count(), 'icon' => Heroicon::OutlinedClock],
                    ['label' => 'Confirmed Bookings', 'value' => Booking::where('status', 'confirmed')->count(), 'icon' => Heroicon::OutlinedCheckCircle],
                    ['label' => 'Completed Tours', 'value' => Booking::where('status', 'completed')->count(), 'icon' => Heroicon::OutlinedFlag],
                ],
            ],
            [
                'label' => 'Revenue',
                'accent' => 'blue',
                'stats' => [
                    ['label' => "Today's Revenue", 'value' => 'USD '.number_format(Booking::whereDate('created_at', $today)->sum('quoted_price'), 2), 'icon' => Heroicon::OutlinedBanknotes],
                    ['label' => 'Monthly Revenue', 'value' => 'USD '.number_format(Booking::whereMonth('created_at', now()->month)->sum('quoted_price'), 2), 'icon' => Heroicon::OutlinedChartBar],
                    ['label' => 'Customers', 'value' => Customer::count(), 'icon' => Heroicon::OutlinedUsers],
                ],
            ],
            [
                'label' => 'Engagement',
                'accent' => 'maroon',
                'stats' => [
                    ['label' => 'Unread Inquiries', 'value' => Inquiry::where('status', 'new')->count(), 'icon' => Heroicon::OutlinedEnvelope],
                    ['label' => 'Blog Posts', 'value' => Post::count(), 'icon' => Heroicon::OutlinedDocumentText],
                    ['label' => 'Testimonials', 'value' => Testimonial::count(), 'icon' => Heroicon::OutlinedStar],
                ],
            ],
        ];
    }
}
