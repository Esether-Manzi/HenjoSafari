<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Pages\Dashboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardRenderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function test_dashboard_mounts_without_errors(): void
    {
        Livewire::test(Dashboard::class)->assertSuccessful();
    }

    public function test_dashboard_widgets_mount_without_errors(): void
    {
        Livewire::test(\App\Filament\Widgets\DashboardWelcomeWidget::class)->assertSuccessful();
        Livewire::test(\App\Filament\Widgets\DashboardStatsWidget::class)->assertSuccessful();
        Livewire::test(\App\Filament\Widgets\QuickActionsWidget::class)->assertSuccessful();
        Livewire::test(\App\Filament\Widgets\BookingsTrendWidget::class)->assertSuccessful();
        Livewire::test(\App\Filament\Widgets\RecentBookingsWidget::class)->assertSuccessful();
    }
}
