<?php

namespace App\Filament\Resources\Destinations\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class DestinationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Destination Information')
                    ->icon(Heroicon::OutlinedMapPin)
                    ->iconColor('gold')
                    ->columns(2)
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
                            ->disabled()
                            ->dehydrated()
                            ->helperText('This will be automatically generated from the name.'),
                        TextInput::make('best_time_to_visit')
                            ->placeholder('June-October'),
                        TextInput::make('starting_price')
                            ->numeric()
                            ->prefix('$'),
                        TextInput::make('tagline')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->columnSpanFull()
                            ->rows(6),
                    ]),

                Section::make('Highlights')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->iconColor('purple')
                    ->description('Short bullet points shown on the destination page.')
                    ->schema([
                        Repeater::make('highlights')
                            ->hiddenLabel()
                            ->simple(
                                TextInput::make('highlight')->required()->maxLength(255)
                            )
                            ->columnSpanFull(),
                    ]),

                Section::make('Media')
                    ->icon(Heroicon::OutlinedPhoto)
                    ->iconColor('teal')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('hero')
                            ->label('Hero Image')
                            ->collection('hero')
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->columnSpanFull(),
                    ]),

                Section::make('Status')
                    ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
                    ->iconColor('blue')
                    ->columns(2)
                    ->schema([
                        Toggle::make('featured')
                            ->required()
                            ->inline(false),
                        Toggle::make('is_active')
                            ->required()
                            ->default(true)
                            ->inline(false),
                    ]),
            ]);
    }
}
