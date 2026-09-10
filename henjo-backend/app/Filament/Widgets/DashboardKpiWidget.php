<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Inquiry;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class DashboardKpiWidget extends Widget
{
    protected string $view = 'filament.widgets.dashboard-kpi';

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    public array $cards = [];

    public function mount(): void
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfLastMonth = Carbon::now()->subMonthNoOverflow()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonthNoOverflow()->endOfMonth();

        // ---- Revenue ------------------------------------------------------
        $revenueThisMonth = (float) Booking::where('created_at', '>=', $startOfMonth)->sum('quoted_price');
        $revenueLastMonth = (float) Booking::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->sum('quoted_price');

        // ---- Bookings ----------------------------------------------------
        $bookingsThisMonth = Booking::where('created_at', '>=', $startOfMonth)->count();
        $bookingsLastMonth = Booking::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        // ---- Needs attention -------------------------------------------
        $pendingBookings = Booking::where('status', 'pending')->count();
        $newInquiries = Inquiry::where('status', 'new')->count();

        // ---- Customers -------------------------------------------------
        $customersTotal = Customer::count();
        $customersThisMonth = Customer::where('created_at', '>=', $startOfMonth)->count();
        $customersLastMonth = Customer::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        $this->cards = [
            [
                'label' => 'Revenue this month',
                'value' => round($revenueThisMonth),
                'format' => 'currency',
                'icon' => 'heroicon-o-banknotes',
                'accent' => 'gold',
                'spark' => $this->dailySum(Booking::query(), 'quoted_price', 14),
                ...$this->delta($revenueThisMonth, $revenueLastMonth, 'vs last month'),
            ],
            [
                'label' => 'Bookings this month',
                'value' => $bookingsThisMonth,
                'format' => 'number',
                'icon' => 'heroicon-o-calendar-days',
                'accent' => 'green',
                'spark' => $this->dailyCount(Booking::query(), 14),
                ...$this->delta($bookingsThisMonth, $bookingsLastMonth, 'vs last month'),
            ],
            [
                'label' => 'Needs attention',
                'value' => $pendingBookings + $newInquiries,
                'format' => 'number',
                'icon' => 'heroicon-o-bell-alert',
                'accent' => 'maroon',
                'spark' => $this->dailyCount(Inquiry::query(), 14),
                'delta' => null,
                'deltaDir' => 'flat',
                'hint' => "{$pendingBookings} pending \u{00B7} {$newInquiries} inquiries",
            ],
            [
                'label' => 'Customers',
                'value' => $customersTotal,
                'format' => 'number',
                'icon' => 'heroicon-o-user-group',
                'accent' => 'blue',
                'spark' => $this->dailyCount(Customer::query(), 14),
                ...$this->delta($customersThisMonth, $customersLastMonth, 'new this month'),
            ],
        ];
    }

    /**
     * @return array{delta: ?string, deltaDir: string, hint: string}
     */
    protected function delta(float $current, float $previous, string $hint): array
    {
        if ($previous <= 0) {
            return [
                'delta' => $current > 0 ? 'New' : null,
                'deltaDir' => $current > 0 ? 'up' : 'flat',
                'hint' => $hint,
            ];
        }

        $change = (($current - $previous) / $previous) * 100;

        return [
            'delta' => number_format(abs($change), $change == 0 ? 0 : 1).'%',
            'deltaDir' => $change > 0 ? 'up' : ($change < 0 ? 'down' : 'flat'),
            'hint' => $hint,
        ];
    }

    protected function days(int $count): Collection
    {
        return collect(range($count - 1, 0))->map(fn (int $ago) => Carbon::today()->subDays($ago));
    }

    protected function dailyCount(Builder $query, int $count): array
    {
        $days = $this->days($count);

        $byDate = $query
            ->selectRaw('DATE(created_at) as d, COUNT(*) as total')
            ->where('created_at', '>=', $days->first())
            ->groupBy('d')
            ->pluck('total', 'd');

        return $days->map(fn (Carbon $day) => (int) ($byDate[$day->toDateString()] ?? 0))->all();
    }

    protected function dailySum(Builder $query, string $column, int $count): array
    {
        $days = $this->days($count);

        $byDate = $query
            ->selectRaw("DATE(created_at) as d, SUM({$column}) as total")
            ->where('created_at', '>=', $days->first())
            ->groupBy('d')
            ->pluck('total', 'd');

        return $days->map(fn (Carbon $day) => (float) ($byDate[$day->toDateString()] ?? 0))->all();
    }
}
