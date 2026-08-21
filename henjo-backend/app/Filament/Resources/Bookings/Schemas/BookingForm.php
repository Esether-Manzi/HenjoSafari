<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\Customer;
use App\Models\SafariPackage;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Booking')
                    ->icon(Heroicon::OutlinedRectangleStack)
                    ->iconColor('gold')
                    ->columns(2)
                    ->schema([
                        TextInput::make('booking_number')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('pending')
                            ->required(),
                    ]),

                Section::make('Customer & Package')
                    ->icon(Heroicon::OutlinedUserGroup)
                    ->iconColor('blue')
                    ->columns(2)
                    ->schema([
                        Select::make('customer_id')
                            ->label('Customer')
                            ->relationship('customer', 'first_name')
                            ->getOptionLabelFromRecordUsing(fn (Customer $record) => trim("{$record->first_name} {$record->last_name}")." ({$record->email})")
                            ->searchable(['first_name', 'last_name', 'email'])
                            ->preload()
                            ->required(),
                        Select::make('package_id')
                            ->label('Tour Package')
                            ->relationship('safariPackage', 'title')
                            ->getOptionLabelFromRecordUsing(fn (SafariPackage $record) => $record->title)
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->helperText('Leave empty if a specific package hasn\'t been assigned yet.'),
                    ]),

                Section::make('Trip Details')
                    ->icon(Heroicon::OutlinedCalendarDays)
                    ->iconColor('green')
                    ->columns(3)
                    ->schema([
                        DatePicker::make('travel_date')
                            ->required(),
                        TextInput::make('adults')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->default(1),
                        TextInput::make('children')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->default(0),
                        TextInput::make('total_people')
                            ->required()
                            ->numeric()
                            ->minValue(1),
                        Textarea::make('special_requests')
                            ->default(null)
                            ->columnSpan(2),
                    ]),

                Section::make('Pricing')
                    ->icon(Heroicon::OutlinedBanknotes)
                    ->iconColor('maroon')
                    ->columns(2)
                    ->schema([
                        TextInput::make('quoted_price')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                        Select::make('currency')
                            ->options([
                                'USD' => 'USD',
                                'EUR' => 'EUR',
                                'UGX' => 'UGX',
                                'KES' => 'KES',
                                'TZS' => 'TZS',
                            ])
                            ->default('USD')
                            ->required(),
                    ]),
            ]);
    }
}
