<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Concerns\ExportsCsv;
use App\Models\Inquiry;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class InquiriesReportWidget extends BaseWidget
{
    use ExportsCsv;

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 5;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Inquiries')
            ->description('Contact-form inquiries, filterable by status.')
            ->query(Inquiry::query()->with('safariPackage'))
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->columns([
                TextColumn::make('name')->searchable()->weight('semibold')->icon('heroicon-o-user-circle')->iconColor('info'),
                TextColumn::make('email')->searchable()->icon('heroicon-o-envelope')->copyable(),
                TextColumn::make('phone')->placeholder('—'),
                TextColumn::make('safariPackage.title')->label('Package')->placeholder('General inquiry')->badge()->color('gray'),
                TextColumn::make('subject')->placeholder('—')->limit(30),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'contacted' => 'info',
                        'closed' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')->label('Received')->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'new' => 'New',
                    'contacted' => 'Contacted',
                    'closed' => 'Closed',
                ]),
            ])
            ->headerActions([
                Action::make('export')
                    ->label('Export CSV')
                    ->icon(Heroicon::OutlinedArrowDownTray)
                    ->action(function () {
                        $inquiries = Inquiry::query()->with('safariPackage')->latest()->get();

                        return $this->exportCsv(
                            'inquiries-report-' . now()->format('Y-m-d') . '.csv',
                            ['Name', 'Email', 'Phone', 'Package', 'Subject', 'Status', 'Received'],
                            $inquiries->map(fn (Inquiry $i) => [
                                $i->name,
                                $i->email,
                                $i->phone,
                                $i->safariPackage?->title,
                                $i->subject,
                                $i->status,
                                $i->created_at->format('Y-m-d H:i'),
                            ]),
                        );
                    }),
            ]);
    }
}
