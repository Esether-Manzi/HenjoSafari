<?php

namespace App\Filament\Resources\Activities\Schemas;

use App\Models\Activity;
use App\Support\SafariIcons;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ActivityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('image')
                    ->label('Activity Image')
                    ->state(fn (Activity $record): ?string => $record->getFirstMediaUrl('image')),
                TextEntry::make('name'),
                TextEntry::make('icon')
                    ->label('Icon')
                    ->html()
                    ->state(fn (Activity $record): string => ($record->icon
                        ? SafariIcons::preview($record->icon).' '.e(SafariIcons::label($record->icon))
                        : null) ?? '-'),
                TextEntry::make('slug'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Activity $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
