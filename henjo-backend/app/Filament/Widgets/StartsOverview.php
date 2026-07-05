<?php

namespace App\Filament\Widgets;

use App\Models\Tour;
use App\Models\Destination;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Inquiry;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        
        // Booking statistics
        $todayBookings = Booking::whereDate('created_at', $today)->count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $completedTours = Booking::where('status', 'completed')->count();
        
        // Revenue
        $todayRevenue = Payment::whereDate('created_at', $today)
            ->where('status', 'completed')
            ->sum('amount');
            
        $monthlyRevenue = Payment::whereBetween('created_at', [$thisMonth, now()])
            ->where('status', 'completed')
            ->sum('amount');
        
        return [
            Stat::make('Total Safari Packages', Tour::count())
                ->description('Active packages')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('primary')
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->url(route('filament.admin.resources.tours.index')),
                
            Stat::make('Total Destinations', Destination::count())
                ->description('Safari destinations')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('success'),
                
            Stat::make("Today's Bookings", $todayBookings)
                ->description('New bookings today')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),
                
            Stat::make('Pending Bookings', $pendingBookings)
                ->description('Requires action')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger')
                ->url(route('filament.admin.resources.bookings.index', [
                    'tableFilters' => ['status' => ['value' => 'pending']]
                ])),
                
            Stat::make('Confirmed Bookings', $confirmedBookings)
                ->description('Upcoming tours')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
                
            Stat::make('Completed Tours', $completedTours)
                ->description('All time')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('gray'),
                
            Stat::make("Today's Revenue", '$' . Number::format($todayRevenue, 2))
                ->description('Completed payments')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
                
            Stat::make('Monthly Revenue', '$' . Number::format($monthlyRevenue, 2))
                ->description($thisMonth->format('M') . ' ' . now()->format('Y'))
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('primary'),
                
            Stat::make('Customers', Customer::count())
                ->description('Registered customers')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
                
            Stat::make('Unread Inquiries', Inquiry::where('is_read', false)->count())
                ->description('Needs response')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger'),
                
            Stat::make('Blog Posts', BlogPost::where('status', 'published')->count())
                ->description('Published articles')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('gray'),
                
            Stat::make('Testimonials', Testimonial::where('is_approved', true)->count())
                ->description('Approved reviews')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
        ];
    }
}