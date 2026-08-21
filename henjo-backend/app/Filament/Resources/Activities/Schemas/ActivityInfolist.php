<?php

namespace App\Filament\Resources\Activities\Schemas;

use App\Models\Activity;
use App\Support\SafariIcons;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ActivityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Image')
                    ->icon(Heroicon::OutlinedPhoto)
                    ->iconColor('teal')
                    ->schema([
                        ImageEntry::make('image')
                            ->hiddenLabel()
                            ->state(fn (Activity $record): ?string => $record->getFirstMediaUrl('image'))
                            ->height('14rem')
                            ->extraImgAttributes(['class' => 'rounded-xl object-cover w-full']),
                    ]),

                Section::make('Activity Information')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->iconColor('gold')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')->weight('bold'),
                        TextEntry::make('slug')->badge()->color('gray'),
                        TextEntry::make('icon')
                            ->label('Icon')
                            ->html()
                            ->state(fn (Activity $record): string => ($record->icon
                                ? SafariIcons::preview($record->icon).' '.e(SafariIcons::label($record->icon))
                                : null) ?? '-'),
                        TextEntry::make('description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),

                Section::make('Record')
                    ->icon(Heroicon::OutlinedClock)
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('deleted_at')
                            ->dateTime()
                            ->badge()
                            ->color('danger')
                            ->visible(fn (Activity $record): bool => $record->trashed()),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
