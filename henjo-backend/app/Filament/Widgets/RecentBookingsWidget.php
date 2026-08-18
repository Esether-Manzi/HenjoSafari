<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Bookings\BookingResource;
use App\Models\Booking;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentBookingsWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Recent Bookings')
            ->query(Booking::query()->latest()->limit(8))
            ->paginated(false)
            ->recordUrl(fn (Booking $record) => BookingResource::getUrl('view', ['record' => $record]))
            ->columns([
                TextColumn::make('booking_number')
                    ->label('Booking #')
                    ->searchable(),
                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->placeholder('—')
                    ->searchable(),
                TextColumn::make('safariPackage.title')
                    ->label('Package')
                    ->placeholder('Not yet assigned'),
                TextColumn::make('travel_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('quoted_price')
                    ->money(fn (Booking $record): string => $record->currency)
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
            ]);
    }
}
