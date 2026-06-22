<?php

namespace App\Filament\Resources\Destinatons\Pages;

use App\Filament\Resources\Destinatons\DestinatonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDestinatons extends ListRecords
{
    protected static string $resource = DestinatonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
