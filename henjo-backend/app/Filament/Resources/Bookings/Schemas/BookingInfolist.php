<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('booking_number')
                    ->label('Booking #'),
                TextEntry::make('customer_name')
                    ->label('Customer')
                    ->getStateUsing(fn ($record) => $record->customer
                        ? trim("{$record->customer->first_name} {$record->customer->last_name}")
                        : '—'),
                TextEntry::make('customer.email')
                    ->label('Email')
                    ->placeholder('-'),
                TextEntry::make('customer.phone')
                    ->label('Phone')
                    ->placeholder('-'),
                TextEntry::make('package_name')
                    ->label('Tour Package')
                    ->getStateUsing(fn ($record) => $record->safariPackage?->title ?? 'Not yet assigned'),
                TextEntry::make('travel_date')
                    ->date(),
                TextEntry::make('adults')
                    ->numeric(),
                TextEntry::make('children')
                    ->numeric(),
                TextEntry::make('total_people')
                    ->numeric(),
                TextEntry::make('quoted_price')
                    ->money(fn ($record) => $record->currency ?? 'USD'),
                TextEntry::make('special_requests')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
