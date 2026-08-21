<?php

namespace App\Filament\Resources\Customers;

use App\Filament\Resources\Customers\Pages\CreateCustomer;
use App\Filament\Resources\Customers\Pages\EditCustomer;
use App\Filament\Resources\Customers\Pages\ListCustomers;
use App\Filament\Resources\Customers\Pages\ViewCustomer;
use App\Models\Customer;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $navigationLabel = 'Customers';

    protected static ?string $modelLabel = 'Customer';

    protected static ?string $pluralModelLabel = 'Customers';

    protected static string|UnitEnum|null $navigationGroup = 'Bookings';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'first_name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Personal Details')
                ->icon(Heroicon::OutlinedIdentification)
                ->iconColor('gold')
                ->columns(2)
                ->schema([
                    TextInput::make('first_name')->required()->maxLength(255),
                    TextInput::make('last_name')->required()->maxLength(255),
                    TextInput::make('country')->maxLength(255)->prefixIcon(Heroicon::OutlinedGlobeAlt),
                ]),

            Section::make('Contact')
                ->icon(Heroicon::OutlinedPhone)
                ->iconColor('blue')
                ->columns(2)
                ->schema([
                    TextInput::make('email')->email()->required()->prefixIcon(Heroicon::OutlinedEnvelope),
                    TextInput::make('phone')->maxLength(50)->prefixIcon(Heroicon::OutlinedPhone),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Personal Details')
                ->icon(Heroicon::OutlinedIdentification)
                ->iconColor('gold')
                ->columns(2)
                ->schema([
                    TextEntry::make('first_name')->weight('bold'),
                    TextEntry::make('last_name')->weight('bold'),
                    TextEntry::make('country')->icon(Heroicon::OutlinedGlobeAlt)->placeholder('-'),
                ]),

            Section::make('Contact')
                ->icon(Heroicon::OutlinedPhone)
                ->iconColor('blue')
                ->columns(2)
                ->schema([
                    TextEntry::make('email')->icon(Heroicon::OutlinedEnvelope)->copyable(),
                    TextEntry::make('phone')->icon(Heroicon::OutlinedPhone)->placeholder('-'),
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')->searchable()->sortable(),
                TextColumn::make('last_name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('phone'),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCustomers::route('/'),
            'create' => CreateCustomer::route('/create'),
            'view' => ViewCustomer::route('/{record}'),
            'edit' => EditCustomer::route('/{record}/edit'),
        ];
    }
}
