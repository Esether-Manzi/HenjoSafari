<?php

namespace App\Filament\Resources\Drivers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DriverForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('bio')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('photo')
                    ->default(null),
                Textarea::make('languages')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('experience_years')
                    ->numeric()
                    ->default(null),
                Textarea::make('certifications')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
