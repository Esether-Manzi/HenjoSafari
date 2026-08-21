<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Booking')
                    ->icon(Heroicon::OutlinedRectangleStack)
                    ->iconColor('gold')
                    ->schema([
                        TextInput::make('booking_id')
                            ->required()
                            ->numeric(),
                    ]),

                Section::make('Payment')
                    ->icon(Heroicon::OutlinedBanknotes)
                    ->iconColor('green')
                    ->columns(2)
                    ->schema([
                        TextInput::make('amount')
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
                        Select::make('payment_method')
                            ->options([
                                'cash' => 'Cash',
                                'bank_transfer' => 'Bank Transfer',
                                'credit_card' => 'Credit Card',
                                'mobile_money' => 'Mobile Money',
                                'paypal' => 'PayPal',
                            ])
                            ->required(),
                        TextInput::make('transaction_reference')
                            ->label('Transaction Reference')
                            ->default(null),
                    ]),

                Section::make('Status')
                    ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
                    ->iconColor('maroon')
                    ->columns(2)
                    ->schema([
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'completed' => 'Completed',
                                'failed' => 'Failed',
                            ])
                            ->default('pending')
                            ->required(),
                        DateTimePicker::make('paid_at'),
                    ]),
            ]);
    }
}
