<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Bookings\BookingResource;
use App\Models\Booking;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentBookingsWidget extends BaseWidget
{
    protected int|string|array $columnSpan = ['default' => 'full', 'lg' => 2];

    protected static ?int $sort = 5;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Recent bookings')
            ->description('The eight most recent bookings')
            ->headerActions([
                Action::make('viewAll')
                    ->label('View all')
                    ->icon(Heroicon::OutlinedArrowRight)
                    ->color('gray')
                    ->url(fn () => BookingResource::getUrl('index')),
            ])
            ->query(Booking::query()->with(['customer', 'safariPackage'])->latest()->limit(8))
            ->paginated(false)
            ->recordUrl(fn (Booking $record) => BookingResource::getUrl('view', ['record' => $record]))
            ->columns([
                TextColumn::make('booking_number')
                    ->label('Booking #')
                    ->weight('semibold')
                    ->searchable(),
                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->placeholder('Guest')
                    ->searchable(),
                TextColumn::make('safariPackage.title')
                    ->label('Package')
                    ->placeholder('Not yet assigned')
                    ->limit(32)
                    ->tooltip(fn (?string $state) => $state)
                    ->toggleable(),
                TextColumn::make('travel_date')
                    ->date('M j, Y')
                    ->sortable(),
                TextColumn::make('quoted_price')
                    ->label('Price')
                    ->money(fn (Booking $record): string => $record->currency)
                    ->weight('semibold')
                    ->color('success')
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
