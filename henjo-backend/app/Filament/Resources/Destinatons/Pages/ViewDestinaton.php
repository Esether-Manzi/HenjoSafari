<?php

namespace App\Filament\Resources\Destinatons\Pages;

use App\Filament\Resources\Destinatons\DestinatonResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDestinaton extends ViewRecord
{
    protected static string $resource = DestinatonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
