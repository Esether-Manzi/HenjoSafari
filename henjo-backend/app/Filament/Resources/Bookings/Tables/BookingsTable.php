<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->with(['customer', 'safariPackage']))
            ->columns([
                TextColumn::make('booking_number')
                    ->label('Booking #')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->getStateUsing(fn ($record) => $record->customer
                        ? trim("{$record->customer->first_name} {$record->customer->last_name}")
                        : '—')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->orWhereHas('customer', function (Builder $q) use ($search) {
                            $q->where('first_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        });
                    }),
                TextColumn::make('package_name')
                    ->label('Tour Package')
                    ->getStateUsing(fn ($record) => $record->safariPackage?->title ?? 'Not yet assigned')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->orWhereHas('safariPackage', function (Builder $q) use ($search) {
                            $q->where('title', 'like', "%{$search}%");
                        });
                    }),
                TextColumn::make('travel_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('total_people')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quoted_price')
                    ->money(fn ($record) => $record->currency ?? 'USD')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
