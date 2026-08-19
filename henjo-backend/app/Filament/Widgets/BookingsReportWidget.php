<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Concerns\ExportsCsv;
use App\Models\Booking;
use App\Models\Destination;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class BookingsReportWidget extends BaseWidget
{
    use ExportsCsv;

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 1;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Bookings')
            ->description('Every booking, filterable by status, destination, and travel date.')
            ->query(Booking::query()->with(['customer', 'safariPackage.destination']))
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->columns([
                TextColumn::make('booking_number')->label('Booking #')->searchable()->weight('semibold')->icon('heroicon-o-ticket')->iconColor('warning'),
                TextColumn::make('customer.name')->label('Customer')->placeholder('—')->searchable(),
                TextColumn::make('safariPackage.title')->label('Package')->placeholder('Not yet assigned')->wrap(),
                TextColumn::make('safariPackage.destination.name')->label('Destination')->placeholder('—')->badge()->color('gray'),
                TextColumn::make('travel_date')->date()->sortable(),
                TextColumn::make('total_people')->label('Travelers')->sortable()->icon('heroicon-o-users')->alignCenter(),
                TextColumn::make('quoted_price')->label('Price')->money(fn (Booking $record): string => $record->currency)->sortable()->weight('bold')->color('success'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')->label('Booked On')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'pending' => 'Pending',
                    'confirmed' => 'Confirmed',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ]),
                SelectFilter::make('destination')
                    ->options(fn () => Destination::pluck('name', 'id'))
                    ->query(function (Builder $query, array $data) {
                        if (blank($data['value'] ?? null)) {
                            return;
                        }
                        $query->whereHas('safariPackage', fn (Builder $q) => $q->where('destination_id', $data['value']));
                    }),
                Filter::make('travel_date')
                    ->schema([
                        \Filament\Forms\Components\DatePicker::make('from'),
                        \Filament\Forms\Components\DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['from'] ?? null, fn (Builder $q, $date) => $q->whereDate('travel_date', '>=', $date))
                            ->when($data['until'] ?? null, fn (Builder $q, $date) => $q->whereDate('travel_date', '<=', $date));
                    }),
            ])
            ->headerActions([
                Action::make('export')
                    ->label('Export CSV')
                    ->icon(Heroicon::OutlinedArrowDownTray)
                    ->action(function () {
                        $bookings = Booking::query()
                            ->with(['customer', 'safariPackage.destination'])
                            ->latest()
                            ->get();

                        return $this->exportCsv(
                            'bookings-report-' . now()->format('Y-m-d') . '.csv',
                            ['Booking #', 'Customer', 'Package', 'Destination', 'Travel Date', 'Travelers', 'Price', 'Currency', 'Status', 'Booked On'],
                            $bookings->map(fn (Booking $b) => [
                                $b->booking_number,
                                $b->customer?->name,
                                $b->safariPackage?->title,
                                $b->safariPackage?->destination?->name,
                                optional($b->travel_date)->format('Y-m-d'),
                                $b->total_people,
                                $b->quoted_price,
                                $b->currency,
                                $b->status,
                                $b->created_at->format('Y-m-d H:i'),
                            ]),
                        );
                    }),
            ]);
    }
}
