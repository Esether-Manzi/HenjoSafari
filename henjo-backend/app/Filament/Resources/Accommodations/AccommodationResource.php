<?php

namespace App\Filament\Resources\Accommodations;

use App\Filament\Resources\Accommodations\Pages\CreateAccommodation;
use App\Filament\Resources\Accommodations\Pages\EditAccommodation;
use App\Filament\Resources\Accommodations\Pages\ListAccommodations;
use App\Filament\Resources\Accommodations\Pages\ViewAccommodation;
use App\Models\Accommodation;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class AccommodationResource extends Resource
{
    protected static ?string $model = Accommodation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $navigationLabel = 'Accommodation';

    protected static ?string $modelLabel = 'Accommodation';

    protected static ?string $pluralModelLabel = 'Accommodation';

    protected static string|UnitEnum|null $navigationGroup = 'Tour Management';

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required()->maxLength(255),
            TextInput::make('slug')->maxLength(255),
            TextInput::make('type')->maxLength(100),
            TextInput::make('star_rating')->numeric(),
            TextInput::make('location')->maxLength(255),
            Textarea::make('description')->rows(5),
            TextInput::make('website')->url()->maxLength(255),
            TextInput::make('phone')->maxLength(50),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('name'),
            TextEntry::make('type'),
            TextEntry::make('location'),
            TextEntry::make('website'),
            TextEntry::make('phone'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('type'),
                TextColumn::make('location'),
                TextColumn::make('phone'),
            ])
            ->recordActions([
                \Filament\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAccommodations::route('/'),
            'create' => CreateAccommodation::route('/create'),
            'view' => ViewAccommodation::route('/{record}'),
            'edit' => EditAccommodation::route('/{record}/edit'),
        ];
    }
}
