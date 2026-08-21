<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class CountryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Country Information')
                    ->icon(Heroicon::OutlinedGlobeAlt)
                    ->iconColor('green')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')->weight('bold'),
                        TextEntry::make('code')->badge()->color('gray'),
                        TextEntry::make('currency')->badge()->color('gold'),
                    ]),

                Section::make('Record')
                    ->icon(Heroicon::OutlinedClock)
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('created_at')->dateTime()->placeholder('-'),
                        TextEntry::make('updated_at')->dateTime()->placeholder('-'),
                    ]),
            ]);
    }
}
