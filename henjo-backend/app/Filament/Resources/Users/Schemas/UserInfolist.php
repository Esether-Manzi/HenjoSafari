<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Account')
                    ->icon(Heroicon::OutlinedIdentification)
                    ->iconColor('gold')
                    ->columns(2)
                    ->schema([
                        SpatieMediaLibraryImageEntry::make('avatar')
                            ->collection('avatar')
                            ->hiddenLabel()
                            ->circular()
                            ->size(64)
                            ->columnSpanFull(),
                        TextEntry::make('name')->weight('bold'),
                        TextEntry::make('email')
                            ->label('Email address')
                            ->icon(Heroicon::OutlinedEnvelope)
                            ->copyable(),
                    ]),

                Section::make('Security')
                    ->icon(Heroicon::OutlinedShieldCheck)
                    ->iconColor('blue')
                    ->columns(2)
                    ->schema([
                        IconEntry::make('email_verified_at')
                            ->label('Email Verified')
                            ->boolean(fn ($record) => filled($record->email_verified_at)),
                        TextEntry::make('email_verified_at')
                            ->label('Verified At')
                            ->dateTime()
                            ->placeholder('-'),
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
