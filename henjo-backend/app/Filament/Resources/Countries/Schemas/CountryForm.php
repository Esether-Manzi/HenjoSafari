<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Schemas\Components\Section;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Country Information')
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