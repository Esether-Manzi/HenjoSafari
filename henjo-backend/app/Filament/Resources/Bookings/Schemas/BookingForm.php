<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('tour_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('travel_date')
                    ->required(),
                TextInput::make('number_of_people')
                    ->required()
                    ->numeric(),
                TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Textarea::make('special_requests')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['new' => 'New', 'confirmed' => 'Confirmed', 'paid' => 'Paid', 'cancelled' => 'Cancelled'])
                    ->default('new')
                    ->required(),
            ]);
    }
}
