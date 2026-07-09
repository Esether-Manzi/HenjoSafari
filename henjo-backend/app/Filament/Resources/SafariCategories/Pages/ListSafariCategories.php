<?php

namespace App\Filament\Resources\SafariCategories\Pages;

use App\Filament\Resources\SafariCategories\SafariCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSafariCategories extends ListRecords
{
    protected static string $resource = SafariCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
