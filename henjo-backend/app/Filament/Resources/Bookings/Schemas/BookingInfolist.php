<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class BookingInfolist
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
                        TextEntry::make('booking_number')
                            ->label('Booking #')
                            ->weight('bold')
                            ->icon(Heroicon::OutlinedHashtag),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'confirmed' => 'blue',
                                'completed' => 'success',
                                'cancelled' => 'danger',
                                default => 'gray',
                            }),
                    ]),

                Section::make('Customer & Package')
                    ->icon(Heroicon::OutlinedUserGroup)
                    ->iconColor('blue')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('customer_name')
                            ->label('Customer')
                            ->getStateUsing(fn ($record) => $record->customer
                                ? trim("{$record->customer->first_name} {$record->customer->last_name}")
                                : '—'),
                        TextEntry::make('package_name')
                            ->label('Tour Package')
                            ->getStateUsing(fn ($record) => $record->safariPackage?->title ?? 'Not yet assigned'),
                        TextEntry::make('customer.email')
                            ->label('Email')
                            ->icon(Heroicon::OutlinedEnvelope)
                            ->placeholder('-'),
                        TextEntry::make('customer.phone')
                            ->label('Phone')
                            ->icon(Heroicon::OutlinedPhone)
                            ->placeholder('-'),
                    ]),

                Section::make('Trip Details')
                    ->icon(Heroicon::OutlinedCalendarDays)
                    ->iconColor('green')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('travel_date')->date(),
                        TextEntry::make('adults')->numeric(),
                        TextEntry::make('children')->numeric(),
                        TextEntry::make('total_people')->numeric(),
                        TextEntry::make('special_requests')
                            ->placeholder('-')
                            ->columnSpan(2),
                    ]),

                Section::make('Pricing')
                    ->icon(Heroicon::OutlinedBanknotes)
                    ->iconColor('maroon')
                    ->schema([
                        TextEntry::make('quoted_price')
                            ->label('Quoted Price')
                            ->size('lg')
                            ->weight('bold')
                            ->money(fn ($record) => $record->currency ?? 'USD'),
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
