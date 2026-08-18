<?php

namespace Tests\Feature;

use App\Filament\Resources\Activities\Pages\CreateActivity;
use App\Filament\Resources\Activities\Pages\EditActivity;
use App\Filament\Resources\Activities\Pages\ListActivities;
use App\Filament\Resources\SafariCategories\Pages\CreateSafariCategory;
use App\Filament\Resources\SafariCategories\Pages\EditSafariCategory;
use App\Filament\Resources\SafariCategories\Pages\ListSafariCategories;
use App\Models\Activity;
use App\Models\SafariCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class IconPickerRenderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function test_activity_livewire_pages_mount_without_errors(): void
    {
        $activity = Activity::create(['name' => 'Game Drive', 'icon' => 'wildlife']);

        Livewire::test(ListActivities::class)->assertOk();
        Livewire::test(CreateActivity::class)->assertOk();
        Livewire::test(EditActivity::class, ['record' => $activity->getRouteKey()])
            ->assertOk()
            ->assertFormSet(['icon' => 'wildlife']);
    }

    public function test_safari_category_livewire_pages_mount_without_errors(): void
    {
        $category = SafariCategory::create(['name' => 'Wildlife Adventure', 'icon' => 'wildlife']);

        Livewire::test(ListSafariCategories::class)->assertOk();
        Livewire::test(CreateSafariCategory::class)->assertOk();
        Livewire::test(EditSafariCategory::class, ['record' => $category->getRouteKey()])
            ->assertOk()
            ->assertFormSet(['icon' => 'wildlife']);
    }
}
