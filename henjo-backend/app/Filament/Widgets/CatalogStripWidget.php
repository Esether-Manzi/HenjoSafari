<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Activities\ActivityResource;
use App\Filament\Resources\Destinations\DestinationResource;
use App\Filament\Resources\Posts\PostResource;
use App\Filament\Resources\SafariPackages\SafariPackageResource;
use App\Filament\Resources\TeamMembers\TeamMemberResource;
use App\Filament\Resources\Testimonials\TestimonialResource;
use App\Models\Activity;
use App\Models\Destination;
use App\Models\Post;
use App\Models\SafariPackage;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Filament\Widgets\Widget;

class CatalogStripWidget extends Widget
{
    protected string $view = 'filament.widgets.catalog-strip';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public array $items = [];

    public function mount(): void
    {
        $this->items = [
            ['label' => 'Safari Packages', 'value' => SafariPackage::count(), 'icon' => 'heroicon-o-map', 'accent' => 'gold', 'url' => $this->safeUrl(SafariPackageResource::class)],
            ['label' => 'Destinations', 'value' => Destination::count(), 'icon' => 'heroicon-o-map-pin', 'accent' => 'green', 'url' => $this->safeUrl(DestinationResource::class)],
            ['label' => 'Activities', 'value' => Activity::count(), 'icon' => 'heroicon-o-sparkles', 'accent' => 'teal', 'url' => $this->safeUrl(ActivityResource::class)],
            ['label' => 'Testimonials', 'value' => Testimonial::count(), 'icon' => 'heroicon-o-star', 'accent' => 'purple', 'url' => $this->safeUrl(TestimonialResource::class)],
            ['label' => 'Blog Posts', 'value' => Post::count(), 'icon' => 'heroicon-o-document-text', 'accent' => 'blue', 'url' => $this->safeUrl(PostResource::class)],
            ['label' => 'Team Members', 'value' => TeamMember::count(), 'icon' => 'heroicon-o-user-circle', 'accent' => 'maroon', 'url' => $this->safeUrl(TeamMemberResource::class)],
        ];
    }

    protected function safeUrl(string $resource): ?string
    {
        try {
            return $resource::getUrl('index');
        } catch (\Throwable) {
            return null;
        }
    }
}
