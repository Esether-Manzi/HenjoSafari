<?php

namespace App\Filament\Resources\Destinations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use App\Models\Country;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;


class DestinationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Destination Information')
                    ->schema([
                        Select::make('country_id')
                            ->label('Country')
                            ->relationship('country', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true),
                        TextInput::make('slug')
                            // ->required()
                            ->disabled()
                            ->dehydrated()
                            ->helperText('This will be automatically generated from the name.'),
                        Textarea::make('description')
                            ->columnSpanFull()
                            ->rows(6),
                        TextInput::make('best_time_to_visit')
                            ->placeholder('June-October'),
                        Toggle::make('featured')
                            ->required()
                            ->inline(false),
                        Toggle::make('is_active')
                            ->required()
                            ->default(true)
                            ->inline(false),
                    ])->columns(2)

            ]);
    }
}
