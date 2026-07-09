<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Destination;
use App\Models\Inquiry;
use App\Models\Post;
use App\Models\SafariPackage;
use App\Models\Testimonial;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class DashboardStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();

        return [
            Stat::make('Total Safari Packages', SafariPackage::count()),
            Stat::make('Total Destinations', Destination::count()),
            Stat::make('Today\'s Bookings', Booking::whereDate('created_at', $today)->count()),
            Stat::make('Pending Bookings', Booking::where('status', 'pending')->count()),
            Stat::make('Confirmed Bookings', Booking::where('status', 'confirmed')->count()),
            Stat::make('Completed Tours', Booking::where('status', 'completed')->count()),
            Stat::make('Today\'s Revenue', 'USD ' . number_format(Booking::whereDate('created_at', $today)->sum('quoted_price'), 2)),
            Stat::make('Monthly Revenue', 'USD ' . number_format(Booking::whereMonth('created_at', now()->month)->sum('quoted_price'), 2)),
            Stat::make('Customers', Customer::count()),
            Stat::make('Unread Inquiries', Inquiry::where('status', 'new')->count()),
            Stat::make('Blog Posts', Post::count()),
            Stat::make('Testimonials', Testimonial::count()),
        ];
    }
}
