<?php

namespace App\Filament\Resources\Destinations\Schemas;

use App\Models\Destination;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class DestinationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero')
                    ->icon(Heroicon::OutlinedPhoto)
                    ->iconColor('teal')
                    ->schema([
                        SpatieMediaLibraryImageEntry::make('hero')
                            ->collection('hero')
                            ->hiddenLabel()
                            ->height('14rem')
                            ->extraImgAttributes(['class' => 'rounded-xl object-cover w-full']),
                    ])
                    ->visible(fn (Destination $record) => $record->hasMedia('hero')),

                Section::make('Destination Information')
                    ->icon(Heroicon::OutlinedMapPin)
                    ->iconColor('gold')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')->weight('bold'),
                        TextEntry::make('country.name')->label('Country')->icon(Heroicon::OutlinedGlobeAlt),
                        TextEntry::make('best_time_to_visit')->placeholder('-'),
                        TextEntry::make('starting_price')->label('Starting Price')->money('USD')->placeholder('-'),
                        TextEntry::make('tagline')->placeholder('-')->columnSpanFull(),
                        TextEntry::make('description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),

                Section::make('Highlights')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->iconColor('purple')
                    ->schema([
                        TextEntry::make('highlights')
                            ->hiddenLabel()
                            ->listWithLineBreaks()
                            ->bulleted()
                            ->placeholder('No highlights added.'),
                    ]),

                Section::make('Gallery')
                    ->icon(Heroicon::OutlinedSquares2x2)
                    ->iconColor('teal')
                    ->visible(fn (Destination $record) => $record->hasMedia('gallery'))
                    ->schema([
                        SpatieMediaLibraryImageEntry::make('gallery')
                            ->collection('gallery')
                            ->hiddenLabel()
                            ->extraImgAttributes(['class' => 'rounded-lg object-cover'])
                            ->height('6rem'),
                    ]),

                Section::make('Status')
                    ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
                    ->iconColor('blue')
                    ->columns(2)
                    ->schema([
                        IconEntry::make('featured')
                            ->boolean(),
                        IconEntry::make('is_active')
                            ->boolean(),
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
                            ->visible(fn (Destination $record): bool => $record->trashed()),
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
