<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class PaymentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Booking')
                    ->icon(Heroicon::OutlinedRectangleStack)
                    ->iconColor('gold')
                    ->schema([
                        TextEntry::make('booking_id')->numeric(),
                    ]),

                Section::make('Payment')
                    ->icon(Heroicon::OutlinedBanknotes)
                    ->iconColor('green')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('amount')
                            ->size('lg')
                            ->weight('bold')
                            ->money(fn ($record) => $record->currency ?? 'USD'),
                        TextEntry::make('payment_method')->badge()->color('gray'),
                        TextEntry::make('transaction_reference')->label('Transaction Reference')->placeholder('-')->copyable(),
                    ]),

                Section::make('Status')
                    ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
                    ->iconColor('maroon')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'completed' => 'success',
                                'failed' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('paid_at')->dateTime()->placeholder('-'),
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
