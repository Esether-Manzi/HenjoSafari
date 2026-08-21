<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class CountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Country Information')
                    ->icon(Heroicon::OutlinedGlobeAlt)
                    ->iconColor('green')
                    ->description('A safari destination country and its currency.')
                    ->columns(2)
                    ->schema([

                        TextInput::make('name')
                            ->label('Country Name')
                            ->placeholder('e.g. Uganda')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('code')
                            ->label('ISO Code')
                            ->placeholder('UG')
                            ->required()
                            ->maxLength(2)
                            ->unique(ignoreRecord: true),

                        Select::make('currency')
                            ->options([
                                'UGX' => 'Ugandan Shilling (UGX)',
                                'KES' => 'Kenyan Shilling (KES)',
                                'TZS' => 'Tanzanian Shilling (TZS)',
                                'USD' => 'US Dollar (USD)',
                                'EUR' => 'Euro (EUR)',
                            ])
                            ->searchable()
                            ->required(),
                    ]),

            ]);
    }
}
