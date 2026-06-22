<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('capacity')
                    ->numeric()
                    ->default(null),
                Select::make('status')
                    ->options(['available' => 'Available', 'maintenance' => 'Maintenance', 'booked' => 'Booked'])
                    ->default('available')
                    ->required(),
            ]);
    }
}
