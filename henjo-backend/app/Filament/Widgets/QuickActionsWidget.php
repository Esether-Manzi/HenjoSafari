<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Bookings\BookingResource;
use App\Filament\Resources\Destinations\DestinationResource;
use App\Filament\Resources\Inquiries\InquiryResource;
use App\Filament\Resources\Posts\PostResource;
use App\Filament\Resources\SafariPackages\SafariPackageResource;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\Widget;

class QuickActionsWidget extends Widget
{
    protected string $view = 'filament.widgets.quick-actions';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public array $actions = [];

    public function mount(): void
    {
        $this->actions = [
            ['label' => 'New Booking', 'icon' => Heroicon::OutlinedPlusCircle, 'url' => BookingResource::getUrl('create'), 'accent' => 'green'],
            ['label' => 'New Safari Package', 'icon' => Heroicon::OutlinedBookOpen, 'url' => SafariPackageResource::getUrl('create'), 'accent' => 'gold'],
            ['label' => 'New Destination', 'icon' => Heroicon::OutlinedMapPin, 'url' => DestinationResource::getUrl('create'), 'accent' => 'blue'],
            ['label' => 'New Blog Post', 'icon' => Heroicon::OutlinedDocumentText, 'url' => PostResource::getUrl('create'), 'accent' => 'maroon'],
            ['label' => 'View Bookings', 'icon' => Heroicon::OutlinedRectangleStack, 'url' => BookingResource::getUrl('index'), 'accent' => 'green'],
            ['label' => 'View Inquiries', 'icon' => Heroicon::OutlinedEnvelope, 'url' => InquiryResource::getUrl('index'), 'accent' => 'maroon'],
        ];
    }
}
